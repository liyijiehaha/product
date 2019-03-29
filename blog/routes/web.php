<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', function () {
    return response()->view('welcome')->header('Content-Type','text/html');
});



//路由   闭包
// Route::get('/Gxd/index', function () {
//     echo 123;
// });


//路由返回视图
// Route::get('/Gxd', function () {
//      return view('Gxd.gxd');
// });



//默认路由
// Route::get('/Gxd','GxdController@index');




// 路由传参  id
// Route::get('/destroy/{user_id}', function ($user_id) {
//      return $user_id;
// });




//正则约束
// Route::get('/show/{id}','GxdController@show')->where('id','\d');





// Route::get('Gxd/show/{id?}','GxdController@show')->name('show');






//重定向
// Route::redirect('/Gxd','/show/2',301);




//添加用户
Route::get('/User/index','UserController@index');
Route::get('/User/user','UserController@create');
Route::post('/User/adddo','UserController@store');
Route::get('/User/del','UserController@destroy')->name('del');
Route::get('/User/edit','UserController@edit');
Route::post('/User/update','UserController@update');



// Route::get('/aa',function(){
// 	$raw_str = encrypt('高祥栋');
// 	$decrypted_str = decrypt($raw_str);
// 	dd(['after_encrypt'=>$raw_str,'after_decrypt'=>$decrypted_str]);
// });

// Route::get('cookie/response',function(){
// 	Cookie::queue(Cookie::make('site','高祥栋',1));
// 	Cookie::queue('quthor','乐柠',1);
// 	return response('hello',200)
// 	->header('Content-Type','text/plain');
// });



//公告管理
Route::get('/Ads/index','AdsController@index');
Route::get('/Ads/create','AdsController@create');
Route::post('/Ads/store','AdsController@store');
Route::get('/Ads/edit','AdsController@edit');
Route::post('/Ads/update','AdsController@update');
Route::get('/Ads/destroy','AdsController@destroy');






// Route::get('/User/index', function () {
// session(['user'=>['user'=>'gxd']]);
// dd(session('user'));
// })->middleware('login','token');











//登陆认证
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



Route::get('/Login/index','LoginController@index');
Route::post('/Login/store','LoginController@store');









//首页
Route::get('Index/index','IndexController@index');
//全部商品
Route::get('Index/goodslist','IndexController@goodslist');
//购物车
Route::get('Index/car','IndexController@car');
Route::post('Index/caradd','IndexController@caradd');
Route::post('Index/cardel','IndexController@cardel');//购物车删除
Route::post('Index/checkprice','IndexController@checkprice');//购物车总价
Route::post('Index/getprice','IndexController@getprice');//加减号小计改库存
//结算
Route::get('Index/orderlist','IndexController@orderlist');//结算列表
Route::get('Index/add_address','IndexController@add_address');//收货地址列表
Route::post('Index/addaddress','IndexController@addaddress');//添加收货地址
Route::get('Index/address','IndexController@address');//获取顶级
Route::get('Index/getareainfo','IndexController@getareainfo');//获取下一级分类信息
//支付
Route::get('Index/success','IndexController@success');

Route::get('Index/successdo','IndexController@successdo');
//个人中心
Route::get('Index/user','IndexController@user');
//注册
Route::get('Login/reg','LoginController@reg');
Route::post('Login/regadd','LoginController@regadd');
//登录
Route::get('Login/login','LoginController@login');
Route::post('Login/logindo','LoginController@logindo');
//验证码
Route::post('Login/sendemail', 'LoginController@sendemail');
//退出
Route::get('Login/quit','LoginController@quit');
//详情
Route::get('Detail/detail','DetailController@detail');





Route::get('Huan/index','HuanController@index');

//支付
Route::get('/alipay/{orderon}','AliController@alipay');

Route::get('/wappay/{orderon}','AppController@wappay');
Route::get('/returnpay','AppController@returnpay');