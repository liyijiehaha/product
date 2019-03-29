<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="../images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="../http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="../http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="../images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
          <tr>
              <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="allbox"/> 全选</a></td>
          </tr>
      @foreach($data as $key=>$val)
       <tr  goods_id = {{$val->goods_id}}  goods_num = {{$val->goods_num}}>
        <td><input type="checkbox" class="box"></td>
        <td class="dingimg" width="15%"><img src="http://uploaimgs.gxd.com/{{$val->goods_img}}" /></td>
        <td width="50%" id="total">
         <h3>{{$val->goods_name}}</h3>
            单价：<span>{{$val->self_price}}</span><hr>
            库存：<b>{{$val->goods_num}}</b>
        </td>
        <td align="right">
                <input type="button"  class="decrease" value="-">
                <input type="text"  class="crease" value="{{$val->buy_number}}" style="width:30px;height:25px;">
                <input type="button" class="increase" value="+" >
        </td>
       </tr>
       <tr  goods_id = {{$val->goods_id}}>
        <th colspan="4"><strong class="orange">{{$val->self_price*$val->buy_number}}</strong></th>
        <th align="center"><button class="del">删除</button></th>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%" id="checkprice">总计：<strong class="orange">￥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan" id="accounts">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/style.js"></script>
    <!--jq加减-->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/jquery.spinner.js"></script>
    <script src="../layui/layui.js"></script>

   <script>
	  $('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<script>
    $(function(){
    layui.use(['layer'],function(){
        var layer = layui.layer;
        //点击加号
        $(document).on('click','.increase',function () {
            var _this=$(this);
            var buy_number=parseInt(_this.prev("input").val());

            var goods_id=_this.parents('tr').attr('goods_id');

            var goods_num=_this.parents('tr').attr('goods_num');
            if(buy_number>=goods_num){
                _this.prop('disabled',true);
                $('#less').removeAttr('disabled');
            }else{
                buy_number+=1;
                _this.prev("input").val(buy_number);
                _this.siblings("input[class='decrease']").prop('disabled',false);
                $('.decrease').removeAttr('disabled');
            }
            $.post(
                "/Index/getprice",
                {goods_id:goods_id,buy_number:buy_number},
                function(res){
                    getCountPrice();
                    getPrice(_this,buy_number);
                },
            )
        })
        //点击减号
        $(document).on('click','.decrease',function () {
            var _this=$(this);
            var buy_number=parseInt(_this.next("input").val());
            var goods_id=_this.parents('tr').attr('goods_id');
            var goods_num=_this.parents('tr').attr('goods_num');
            if(buy_number<=1){
                _this.prop('disabled',true);
                $('#add').removeAttr('disabled');
            }else{
                buy_number-=1;
                _this.next("input").val(buy_number);
                _this.siblings("input[class='increase']").prop('disabled',false);
                $('.increase').removeAttr('disabled');
            }
            $.post(
                "/Index/getprice",
                {goods_id:goods_id,buy_number:buy_number},
                function(res){
                    getPrice(_this,buy_number);
                    getCountPrice();
                },
            );
        })
        //文本框失去焦点
        $(document).on('blur','.crease',function () {
            var _this=$(this);
            var buy_number=parseInt(_this.val());
            var goods_num=_this.parents('tr').attr('goods_num');
            var goods_id=_this.parents('tr').attr('goods_id');
            //正则验证
            var reg=/^[1-9]\d*$/;
            if(!reg.test(buy_number)){
                _this.val(1);
            }else if(buy_number<=1){
                _this.val(1);
            }else if(buy_number>=goods_num){
                _this.val(goods_num);
            }else{
                _this.val(buy_number);
            }
            $.post(
                "/Index/getprice",
                {goods_id:goods_id,buy_number:buy_number},
                function(res){
                    if(buy_number>=goods_num){
                        getPrice(_this,buy_number=goods_num);
                    }else if(buy_number<=1){
                        getPrice(_this,buy_number=1);
                    }
                    getCountPrice();
                },
            )
        })


        //删除
        $(document).on('click','.del',function(){
            var _this=$(this);
            var goods_id=_this.parents('tr').attr('goods_id');
            // console.log(goods_id);
            //是否确认删除
            layer.confirm('是否确认删除?',{icon:3,title:'提示'},function(index){
                $.post(
                    "/Index/cardel",
                    {goods_id:goods_id},
                    function(res){
                        layer.msg(res.font,{icon:res.code});
                        if(res.code==1){
                            _this.parents('tr').remove();
                        }
                    },
                    'json'
                );
            })
        })


        //单选
        $(document).on('click','.box',function(){
            //获取购物车总价
            getCountPrice();
        })
        //全选
        $('#allbox').click(function(){
            var _this=$(this);
            var status=_this.prop('checked');
            $('.box').prop('checked',status);
            getCountPrice();
        })
        //获取购物车总价
        function getCountPrice(){
            //获取购物车总价
            var box=$('.box');
            var goods_id='';
            box.each(function(index){
                if($(this).prop('checked')==true){
                    goods_id+=$(this).parents('tr').attr('goods_id')+',';
                }
            });
            goods_id=goods_id.substr(0,goods_id.length-1);
            $.post(
                "/Index/checkprice",
                {goods_id:goods_id},
                function(res){
                    $('#checkprice').find('strong').text('￥'+res);
                    // console.log(res);
                }

            )
        }

        //改变小计
        function getPrice(_this,buy_number){
            var self_price=parseInt(_this.parents("td").prev('td').find('span').last().text());
            var total=self_price*buy_number;
            _this.parents("tr").next('tr').find('strong').text(total);
        }



        //点击结算
        $(document).on('click','#accounts',function(){
                var box=$('.box');
                var goods_id='';
                box.each(function(index){
                    if($(this).prop('checked')==true){
                        goods_id+=$(this).parents('tr').attr('goods_id')+',';
                    };
                });
                goods_id=goods_id.substr(0,goods_id.length-1);
                if(goods_id==''){
                    layer.msg("请至少选择一个商品");
                    return false;
                }
                // console.log(goods_id);
            location.href="/Index/orderlist?goods_id="+goods_id;

        })
    })
    })
</script>