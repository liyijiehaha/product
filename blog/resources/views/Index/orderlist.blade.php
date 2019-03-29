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
     <div class="dingdanlist" >
         <table border="0">
             @foreach($addressinfo as $k=>$v)
             <tr address_id="{{$v->address_id}}">
                 @if($v->is_default == 1)
                     <td rowspan="3"><input type="radio" checked name='is_default' value="{{$v->address_id}}"></td>
                 @else
                     <td rowspan="3"><input type="radio"  name='is_default' value="{{$v->address_id}}"></td rowspan="2">
                 @endif
                 <td>收货人名称</td>
                 <td>{{$v->address_name}}</td>
             </tr>
             <tr>
                 <td>收货人地址</td>
                 <td>{{$v->province}}{{$v->city}}{{$v->area}}</td>
             </tr>
             <tr>
                 <td>联系方式</td>
                 <td>{{$v->address_tel}}</td>
             </tr>
             @endforeach
         </table>
         <table>

       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right">
            <ul class="pay">
                <li> <input type="radio" checked name="pay_type"  pay_type="1" class="checked">余额支付</li>
                <li> <input type="radio" name="pay_type"  pay_type="2" >货到付款</li>
                <li> <input type="radio" name="pay_type"  pay_type="3">支付宝</li>
            </ul>
        </td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
          @foreach($goodsinfo as $k=>$v)
      <tr>
        <td class="dingimg" width="15%"><img src="http://uploaimgs.gxd.com/{{$v->goods_img}}" /></td>
        <td width="50%"  goods_id="{{$v->goods_id}}" class="goods_id">
         <h3>{{$v->goods_name}}</h3>
        </td>
        <td align="right"><span class="qingdan">X {{$v->buy_number}}</span></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange">¥{{$v->self_price}}</strong></th>
       </tr>

       <tr>
        <td class="dingimg" width="75%" colspan="2">商品金额</td>
        <td align="right"><strong class="orange">¥{{$v->self_price*$v->buy_number}}</strong></td>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->


    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">￥{{$countprice}}</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">提交订单</a></td>
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
    <script src="../js/jquery.spinner.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../layui/layui.js"></script>
  </body>
</html>
<script>
    $(function(){
        layui.use('layer',function(){




            //付款点击事件
            $(".pay").find("input").click(function(){
                var _this = $(this);
                _this.addClass('checked');
                _this.siblings('input').removeClass('checked');
            });





            //点击提交订单
            $(".jiesuan").click(function(){
                //获取id
                var goods_id='';
                $('.goods_id').each(function(index){
                    goods_id+=$(this).attr('goods_id')+',';
                })
                goods_id = goods_id.substr(0,goods_id.length-1);

                //获取收货地址的id
                var address_id;
                $("input[name='is_default']").each(function(index){
                    if($(this).prop('checked')==true){
                        address_id=$(this).val();
                    }
                })


                //支付方式获取
                var pay_type=$('.checked').attr('pay_type');



                $.get(
                    "/Index/successdo",
                    {goods_id:goods_id,address_id:address_id,pay_type:pay_type},
                    function(res){
                        // console.log(res);
                        layer.msg(res.font,{icon:res.code});
                        if(res.code==1){
                            location.href="/Index/success";
                        }
                    },
                    'json'
                );
            })




        })
    })
</script>