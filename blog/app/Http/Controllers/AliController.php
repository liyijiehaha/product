<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AliController extends Controller
{


    public function alipay($orderon){
        if(!$orderon){
            return redirect('/alipay')->with('没有此订单信息');
        }
        //根据订单号获取订单信息 订单金额
        $order=DB::table('fx_order')->select(['order_amount','order_no'])->where('order_no',$orderon)->first();
//        echo app_path('libs/alipay/pagepay/service/AlipayTradeService.php');die;
        require_once  app_path('alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = trim($orderon);

        //订单名称，必填
        $subject = '测试';

        //付款金额，必填
        $total_amount = trim($order->order_amount);

        //商品描述，可空
        $body = '';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService(config('alipay'));

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,config('alipay.return_url'),config('alipay.notify_url'));

        //输出表单
        var_dump($response);
    }

    public function returnpay(){

    }

}
