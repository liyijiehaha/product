<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">

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
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="../images/head.jpg" />
     </div><!--head-top/-->
     <form action="" method="" class="reg-login" onsubmit="return false">
      <h3>已经有账号了？点此<a class="orange" href="/Login/login">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号" id="user_email"></div>
       <div class="lrList2"><input type="text" placeholder="输入邮箱验证码" id="user_code"><button id="auser_code"><a href="#" id="email">获取验证码</a></button></div>
       <div class="lrList"><input type="password" placeholder="设置新密码（6-18位数字或字母）" id="user_pwd"></div>
       <div class="lrList"><input type="password" placeholder="再次输入密码" id="user_repwd"></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即注册" id="btn"/>
      </div>
     </form><!--reg-login/-->
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
       <a href="user.html">
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
    <script src="../layui/layui.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>

    <script src="../js/style.js"></script>
  </body>
</html>
<script>
    $(function() {
        var emailfalse=false;
        layui.use(['layer'], function () {
            var layer = layui.layer;
            $('#email').click(function () {
                var user_email = $('#user_email').val();
                if(user_email==''){
                    layer.msg('邮箱不能为空', {icon: 2});
                    return false;
                }
                $('#email').text(60 + 's');
                _time = setInterval(secondLess, 1000);
                //发送邮件
                $.ajaxSetup({
                    headers:
                        {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                $.post(
                    "/Login/sendemail",
                    {user_email: user_email},
                    function (res) {
                        if(res.code ==2){
                            layer.msg(res.font, {icon: res.code});
                            emailfalse = false;
                        }else{
                            emailfalse = true;
                        }
                    },
                    'json'
                )
            })
            //倒计时
            function secondLess() {
                var second = parseInt($('#email').text())
                if (second == 0) {
                    $('#email').text('获取');
                    clearInterval(_time);
                    $('#auser_code').css("pointer-events", "auto");
                } else {
                    second = second - 1;
                    $('#email').text(second + 's');
                    $('#auser_code').css("pointer-events", "none");
                }
            }

            var pwdflag = false;
            $('#btn').click(function () {
                var user_code=$('#user_code').val();
                var user_pwd = $("#user_pwd").val();
                var user_repwd = $("#user_repwd").val();
                var user_email = $('#user_email').val();

                if (user_pwd != user_repwd) {
                    layer.msg('密码和确认密码不一致', {icon: 2});
                    return false;
                } else {
                    if (pwdFlag = false) {
                        return pwdFlag;
                    }
                }
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                // console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
                $.post(
                    "/Login/regadd",
                    {user_email: user_email,user_code:user_code,user_pwd:user_pwd,user_repwd:user_repwd},
                    function(res){
                        layer.msg(res.font,{icon:res.code});

                    },
                    'json'
                );
            });
        })
    })
</script>
