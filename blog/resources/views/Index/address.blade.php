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
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="../images/head.jpg" />
     </div><!--head-top/-->
     <form action="" method="" class="reg-login">
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="收货人" id="address_name"/></div>
       <div class="lrList"><input type="text" placeholder="详细地址" id="address_detail"/></div>
       <div class="lrList">
        <select class="area" id="province">
            <option value="" selected="selected">...请选择省...</option>
            @foreach($pidinfo as $k=>$v)
                <option value="{{$v->id}}">{{$v->name}}</option>
            @endforeach
        </select>
       </div>
       <div class="lrList">
        <select  class="area" id="city">
            <option value="" selected="selected">...请选择市...</option>
        </select>
       </div>
       <div class="lrList">
          <select  class="area" id="area">
              <option value="" selected="selected">...请选择区...</option>
          </select>
       </div>
       <div class="lrList">
       </div>
       <div class="lrList"><input type="text" placeholder="手机" id="address_tel"/></div>
       <div class="lrList2"><input type="checkbox" id="is_default"></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" class='add' value="保存" />
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
      <dl class="ftnavCur">
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
    <script src="../js/jquery.excoloSlider.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../layui/layui.js"></script>

    <!--jq加减-->
  </body>
</html>
<script>
    $(function() {
        layui.use('layer', function () {
            $(document).on('change','.area',function(){
                var _this=$(this);
                var id=_this.val();
                var _option="<option selected value='0'>--请选择--</option>";
                _this.parents('div').nextAll('div').find('select').html(_option);
                $.get(
                    "/Index/getareainfo",
                    {id:id},
                    function(res){
                        if(res.code==1){
                            for(var i in res['shiinfo']){
                                _option+="<option value='"+res['shiinfo'][i]['id']+"'>"+res['shiinfo'][i]['name']+"</option>";
                            }
                            _this.parents('div').next('div').find('select').html(_option);
                        }
                    },
                    'json'

                )
            })

            $(document).on('click','.add',function(){
                var obj={};
                obj.address_name=$('#address_name').val();
                obj.address_tel=$('#address_tel').val();
                obj.address_detail=$('#address_detail').val();
                obj.city=$('#city').val();
                obj.province=$('#province').val();
                obj.area=$('#area').val();
                var is_default=$('#is_default').prop('checked');
                if(is_default==true){
                    obj.is_default=1;
                }else{
                    obj.is_default=2;
                }
                if(obj.province==''){
                    layer.msg('请选择城市');
                    return false;
                }
                $.post(
                    "/Index/addaddress",
                    obj,
                    function(res){
                        layer.msg(res.font,{icon:res.code});
                    },'json'
                )

            })




        })
    })
</script>