<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录
    public function login(){
        return view('Login/login');
    }
    public function logindo(Request $request)
    {
        $login_model = new \App\Login;
        $data = $request->all();
        $res = $login_model->where('user_email',$data['user_email'])->first();
        if(!$res){
            $arr=[
              'font'=>'用户名不存在',
              'code'=>2

            ];
            return json_encode($arr);
        }else{
            if($data['user_pwd']!=decrypt($res['user_pwd'])){
                $arr=[
                    'font'=>'登录失败',
                    'code'=>2
                ];
                return json_encode($arr);
            }else {
                session(['user' => ['user_id' => $res->user_id,'user_email' => $res->user_email]]);
                $arr = [
                    'font' => '登录成功',
                    'code' => 1

                ];
                return json_encode($arr);

            }
        }
    }
    //注册
    public function reg()
    {

        return view('Login/reg');
    }
    public function regadd(Request $request)
    {
        $goods_model = new \App\Login;
        $user_email = request()->input('user_email');
        $user_code = request()->input('user_code');
        $user_pwd = request()->input('user_pwd');
        $user_repwd = request()->input('user_repwd');
        $goods_model->user_email = $user_email;
        $goods_model->user_code = $user_code;
        $goods_model->user_pwd = encrypt($user_pwd);
        $usera_code = session('code.user_code');
        if($user_code!=$usera_code){
            $arr=[
                'font'=>'验证码不对',
                'code'=>2

            ];
            return json_encode($arr);
        }
        $res = $goods_model->save();
        if($res){
            $arr=[
                'font'=>'注册成功',
                'code'=>1

            ];
            return json_encode($arr);
        }else{
            $arr=[
                'font'=>'注册失败',
                'code'=>2

            ];
            return json_encode($arr);
        }
    }

    //验证码
    public function sendemail(){
        $rand = rand(100000,999999);
        $flag=Mail::send('Login/sendemail',['data'=>$rand],function($message){
            $to = '17610531571@163.com';
            $message ->to($to)->subject('测试邮件');
        });
        if($flag==''){
            session(['code'=>['user_code'=>$rand]]);
            $arr=[
                'font'=>'发送成功',
                'code'=>1

            ];
            return json_encode($arr);
        }else{
            $arr=[
                'font'=>'发送成功',
                'code'=>2

            ];
            return json_encode($arr);
        }
    }
    //退出
    public function quit(Request $request)
    {
        $request->session('user')->flush();
        return redirect('Index/index')->with('success','成功');
    }




}
