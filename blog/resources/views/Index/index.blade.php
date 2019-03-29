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
     <div class="head-top">
      <img src="../images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="../images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="" class="search">

     </form><!--search/-->
     @if(session('user'))
     @else
         <ul class="reg-login-click">
          <li><a href="/Login/login">登录</a></li>
          <li><a href="/Login/reg" class="rlbg">注册</a></li>
          <div class="clearfix"></div>
         </ul><!--reg-login-click/-->
     @endif
     <div id="sliderA" class="slider">
         @foreach($data as $key=>$val)
      <img src="http://uploaimgs.gxd.com/{{$val->goods_img}}" />
         @endforeach
     </div>
     <ul class="pronav">
     @foreach($data2 as $key=>$val)
      <li><a href="/Index/goodslist">{{$val->cate_name}}</a></li>
     @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
     @foreach($data3 as $key=>$val)
         <div class="index-pro1-list">
       <dl>
        <dt><a href="/Detail/detail?goods_id={{$val->goods_id}}"><img src="http://uploaimgs.gxd.com/{{$val->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="proinfo.html">{{$val->goods_name}}</a><span>库存：{{$val->goods_num}}</span></dd>
        <dd class="ip-price"><strong>¥{{$val->self_price}}</strong> <span>¥{{$val->market_price}}</span></dd>
       </dl>
      </div>
     @endforeach
      <div class="clearfix"></div>

     </div><!--index-pro1/-->
     <div class="prolist">
     @foreach($data4 as $key=>$val)
      <dl>
       <dt><a href="/Detail/detail?goods_id={{$val->goods_id}}"><img src="http://uploaimgs.gxd.com/{{$val->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">{{$val->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$val->self_price}}</strong> <span>¥{{$val->market_price}}</span></div>
        <div class="prolist-yishou"><span>积分：{{$val->market_score}}</span> <em>库存：{{$val->goods_num}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="../images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>

     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="/Index/index">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="/Index/goodslist">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="/Index/car">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="/Index/user">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/style.js"></script>
    <!--焦点轮换-->
    <script src="../js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>