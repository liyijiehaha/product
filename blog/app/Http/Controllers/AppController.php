<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AppController extends Controller
{


    public function wappay($orderon){
        $orderno=DB::table('fx_order')->select(['order_amount','order_no'])->where('order_no',$orderon)->first();
        require_once  app_path('wappay/wappay/service/AlipayTradeService.php');
        require_once  app_path('wappay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
        if (!empty($orderon)&& trim($orderon)!="") {
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $orderno->order_no;

            //订单名称，必填
            $subject = '111';

            //付款金额，必填
            $total_amount = $orderno->order_amount;
            //商品描述，可空
            $body = '测试';

            //超时时间
            $timeout_express = "5m";

            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new \AlipayTradeService(config('alipay'));
            $result = $payResponse->wapPay($payRequestBuilder, config('alipay.return_url'),config('alipay.notify_url'));

            return;
        }
    }
    /*同步*/
    public  function returnpay(){
        echo '支付成功';
        return redirect('/Index/car');
    }
    /*异步*/
    public function returnpayf(){
        $data=$_REQUEST->all();
        dd($data);
    }
}
