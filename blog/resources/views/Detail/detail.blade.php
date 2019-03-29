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
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
     @foreach($data['goods_imgs'] as $k=>$v)
         <img src="http://uploaimgs.gxd.com/{{$v}}" />
     @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr goods_id = {{$data['goods_id']}}  goods_num = {{$data['goods_num']}}>
       <input type="hidden" id="goods_id" value="{{$data['goods_id']}}">
       <th><strong class="orange">商品价格：{{$data['self_price']}}</strong></th>
       <th>库存：<strong>{{$data['goods_num']}}</strong></th>
       <td id="add">
            <input type="text" class="spinnerExample" id="buy_number"/>
       </td>
      </tr>
         <td><button  id="cartAdd"><a href="javascript:;">加入购物车</a></button></td>
         <input type="hidden" id="goods_id" value="{{$data['goods_id']}}">
      <tr>
       <td>
        <strong>{{$data['goods_name']}}</strong>
        <p class="hui">{{$data['goods_desc']}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
         <img src="http://uploaimgs.gxd.com/{{$data['goods_img']}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/style.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <!--焦点轮换-->
    <script src="../js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
     <!--jq加减-->
    <script src="../js/jquery.spinner.js"></script>
    <script src="../layui/layui.js"></script>
<script>
$('.spinnerExample').spinner({});
layui.use(['layer'],function(){
       var layer=layui.layer;
       var goods_num=parseInt($('#goods_num').text());
        //加入购物车
        $('#cartAdd').click(function(){
            var goods_id=$("#goods_id").val();
            var buy_number=$('#buy_number').val();
            $.post(
                "/Index/caradd",
                {goods_id:goods_id,buy_number:buy_number},
                function(res){
                    layer.msg(res.font);
                    if(res.code==3){
                        location.href="/Login/login";
                    }else if(res.code==2){
                        return false;
                    }else{
                        location.href="/Index/car";
                    }
                },
                'json'
            );
        })

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
                _this.next("input").val(buy_number);
                _this.siblings("input[class='decrease']").prop('disabled',false);
                $('.decrease').removeAttr('disabled');
            }
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
                _this.prev("input").val(buy_number);
                _this.siblings("input[class='increase']").prop('disabled',false);
                $('.increase').removeAttr('disabled');
            }
        })
        //文本框失去焦点
        $(document).on('blur','.spinnerExample',function () {
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
            buy_number=parseInt(_this.val());
        })
})
</script>
  </body>
</html>