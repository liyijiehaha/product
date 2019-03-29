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
       <form action="" class="prosearch"><input type="text" name="goods_name"> <button>搜索</button></form>

      </div>

     </header>
     <ul class="pro-select">
      <li class="pro-selCur np"   a_type="1" id="by_num"><a href="#">新品</a></li>
      <li class="num"  id="add"   a_type="1"><a href="#">库存<span >↑</span></a></li>
      <li class="price" id="min"  a_type="1"><a href="#">价格<span >↑</span></a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
     @foreach($data as $key=>$val)
      <dl>
       <dt><a href="/Detail/detail?goods_id={{$val->goods_id}}"><img src="http://uploaimgs.gxd.com/{{$val->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">{{$val->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$val->self_price}}</strong> <span>¥{{$val->market_price}}</span></div>
        <div class="prolist-yishou"><em>积分：{{$val->goods_score}}</em>  <em>库存：{{$val->goods_num}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     @endforeach
     </div><!--prolist/-->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="/Index/index">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl class="ftnavCur">
       <a href="prolist.html">
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
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script>
		$(function () {
            //点击价格
            $(document).on('click','.price',function(){
                //把当前点击的颜色改为红色
                var _this=$(this);
                _this.addClass('pro-selCur');
                _this.siblings('li').removeClass('pro-selCur');
            });
            $(document).on('click','.num',function(){
                //把当前点击的颜色改为红色
                var _this=$(this);
                _this.addClass('pro-selCur');
                _this.siblings('li').removeClass('pro-selCur');
            });
            $(document).on('click','.np',function(){
                //把当前点击的颜色改为红色
                var _this=$(this);
                _this.addClass('pro-selCur');
                _this.siblings('li').removeClass('pro-selCur');
            });



		});
	</script>
  </body>
</html>