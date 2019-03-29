<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    //首页
    public function index(Request $request)
    {
        //轮播图
        $goods_model = new \App\Index;
        $data = $goods_model->get();

        //分类
        $goods_model = new \App\Cate;
        $data2 = $goods_model->where('pid','0')->get();


        //商品 is_best
        $goods_model = new \App\Index;
        $data3= $goods_model->where('is_best','1')->get();

        //is_host
        $goods_model = new \App\Index;
        $data4= $goods_model->where('is_hot','1')->get();
        return view('Index/index',compact('data','data2','data3','data4'));
    }


    //全部商品展示
    public function goodslist(Request $request)
    {
        $goods_model = new \App\Index;
        $query = request()->input();
        //搜索条件
        $where = [];
        if(isset($query['goods_name'])?$query['goods_name']:''){
            $where[]=['goods_name','like',"%$query[goods_name]%"];
        }
        $data = $goods_model->where($where)->get();
        return view('Index/goodslist',compact('data'));
    }


    //购物车
    public function car()
    {
        if(!session('user')){
            return redirect('Index/index');
        }else{
            $data = DB::table('fx_goods')
                ->join('fx_cart', 'fx_goods.goods_id', '=', 'fx_cart.goods_id')
                ->where('cart_status',1)
                ->get();
        }
        return view('Index/car',compact('data'));


    }
    //执行添加购物车
    public  function caradd(Request $request)
    {
        if(!session('user')){
            $arr=[
                'font'=>'请登录',
                'code'=>3
            ];
            return json_encode($arr);die;
        }else{
            $goods_model = new \App\Index;
            $car_model = new \App\Car;
            $data = $request->all();
            $goods_id = $request->goods_id;
            $buy_number = $request->buy_number;
            $where=[
                'goods_id'=>$goods_id,
                'is_up'=>1
            ];
            $res = $goods_model->where($where)->first();
            $carwhere=[
                'goods_id'=>$goods_id,
                'cart_status'=>1
            ];
            $carres =  $car_model->where($carwhere)->first();
            if($carres){
                $cart=$car_model->find($carres['cart_id']);

                $cart->buy_number = $carres['buy_number']+$data['buy_number'];
                $aaa = $cart->save();
                if($aaa){
                    $arr=[
                        'font'=>'加入购物车成功',
                        'code'=>1
                    ];
                    return json_encode($arr);die;
                }else{
                    $arr=[
                        'font'=>'加入购物车失败',
                        'code'=>2
                    ];
                    return json_encode($arr);die;
                }
            }else{
                foreach ($data as $k=>$v){
                    $car_model->$k=$v;
                }
                $car_model->user_id = session('user.user_id');
                $res = $car_model->save();
                if($res){
                    $arr=[
                        'font'=>'加入购物车成功',
                        'code'=>1
                    ];
                    return json_encode($arr);die;
                }else{
                    $arr=[
                        'font'=>'加入购物车失败',
                        'code'=>2
                    ];
                    return json_encode($arr);die;
                }
            }
        }

    }
    //购物车删除
    public function cardel(Request $request){
        if(!session('user')){
            $arr=[
                'font'=>'请登录',
                'code'=>3
            ];
            return json_encode($arr);die;
        }else{
            $goods_id = $request->all('goods_id');
            $car_model = new \App\Car;
            $where = [
                'goods_id'=>$goods_id,
                'user_name'=>session('user.user_email')
            ];
            $info=[
                'cart_status'=>2
            ];
            $res = $car_model->save($info,$where);
            if($res){
                $arr=[
                    'font'=>'删除成功',
                    'code'=>1
                ];
                return json_encode($arr);die;
            }else{
                $arr=[
                    'font'=>'删除失败',
                    'code'=>2
                ];
                return json_encode($arr);die;
            }
        }
    }
    //总价
    public function checkprice(Request $request){
        $goods_id = request()->input('goods_id');
        $goods_id=explode(',',$goods_id);
//        dd($goods_id);
        $where=[
            'user_id'=>session('user.user_id'),
            'cart_status'=>1
        ];


        $info=DB::table('fx_cart')
            ->join('fx_goods', 'fx_goods.goods_id', '=', 'fx_cart.goods_id')
            ->where($where)
            ->whereIn('fx_goods.goods_id',$goods_id)
            ->get();
//        dd($info);
        $countprice=0;
        foreach($info as $k=>$v){
            $countprice+=$v->buy_number*$v->self_price;
        }
        echo $countprice;

    }
    //小计  改变价格
    public function getprice(Request $request){
        $buy_number = $request->input('buy_number');
        $goods_id = $request->input('goods_id');
        $cartdata=[
            'buy_number'=>$buy_number
        ];
        DB::table('fx_cart')->where(['goods_id'=>$goods_id,'user_id'=>session('user.user_id')])->update($cartdata);
    }
    //提交订单
    public function orderlist(Request $request){
        if(!session('user')){
            return redirect('Index/index');
        }
        $goods_model = new \App\Index;
        $car_model = new \App\Car;
        $goods_id = $request->input('goods_id');
        $goods_id = explode(',',$goods_id);
        if(empty($goods_id)){
            echo "至少一个，选商品";exit;
        }
        $goodswhere=[
            'user_id'=>session('user.user_id'),
        ];
        $goodswhere['cart_status']=1;
        $goodsinfo=$goods_model
            ->join("fx_cart","fx_goods.goods_id","=","fx_cart.goods_id")
            ->where($goodswhere)
            ->whereIn('fx_goods.goods_id',$goods_id)
            ->get();

        $countprice=0;
        foreach($goodsinfo as $k=>$v){
            $countprice+=$v->buy_number*$v->self_price;
        }

        $address_model = new \App\Address;
        $area_model = new \App\Area;
        $areawhere=[
            'user_id'=>session('user.user_id'),
            'address_status'=>1
        ];
        $addressinfo= $area_model->where($areawhere)->get();
        foreach($addressinfo as $k=>$v){
            $addressinfo[$k]['province']=$address_model->where(['id'=>$v['province']])->value('name');
            $addressinfo[$k]['city']=$address_model->where(['id'=>$v['city']])->value('name');
            $addressinfo[$k]['area']=$address_model->where(['id'=>$v['area']])->value('name');
        }
        return view('/Index/orderlist',compact('goodsinfo','countprice','addressinfo'));
    }


    //收货地址列表
    public function add_address(Request $request){
        //获取收货地址
        $address_model = new \App\Address;
        $area_model = new \App\Area;
        $areawhere=[
            'user_id'=>session('user.user_id'),
            'address_status'=>1
        ];
        $areainfo = $area_model->where($areawhere)->get();
        foreach($areainfo as $k=>$v){
            $areainfo[$k]['province']=$address_model->where(['id'=>$v['province']])->value('name');
            $areainfo[$k]['city']=$address_model->where(['id'=>$v['city']])->value('name');
            $areainfo[$k]['area']=$address_model->where(['id'=>$v['area']])->value('name');
        }
        return view('/Index/add_address',compact('areainfo'));
    }
    //收货地址添加
    public function addaddress(Request $request){
        $data = $request->all();
        $data['user_id']=session('user.user_id');
        $area_model = new \App\Area;
        if($data['is_default']==1){
            $userwhere = [
                'user_id'=>session('user.user_id')
            ];
            DB::beginTransaction();
            $res=$area_model->where($userwhere)->update(['is_default'=>2]);
            $resa=$area_model->insert($data);
            if($res!==false&&$resa){
                DB::commit();
                $arr=[
                    'font'=>'添加成功',
                    'code'=>1
                ];
                return json_encode($arr);
            }else{
                DB::rollBack();
                $arr=[
                    'font'=>'添加失败',
                    'code'=>2
                ];
                return json_encode($arr);die;
            }
        }
    }
    //获取顶级
    public function address(Request $request){
        //获取省级
        $awhere = [
            'pid'=>0
        ];
        $address_model = new \App\Address;
        $pidinfo = $address_model->where($awhere)->get();
        return view('/Index/address',compact('pidinfo'));
    }
    //获取下一级分类信息
    public function getareainfo(Request $request){
        $address_model = new \App\Address;
        $id=request()->input('id');
        $bwhere = [
            'pid'=>$id
        ];

        $shiinfo = $address_model->where($bwhere)->get();
        echo json_encode(['shiinfo'=>$shiinfo,'code'=>1]);
    }


    //执行结算
    public function successdo(Request $request){
        if(!session('user')){
            return redirect('Index/index');die;

        }
        $goods_id=$request->input('goods_id');
        $goods_id=explode(',',$goods_id);
        $address_id=$request->input('address_id');
        $pay_type=$request->input('pay_type');
//        DB::beginTransaction();
        $user_id = session('user.user_id');
        //存入订单表
        $orderinfo['order_no']=time().rand(1111,9999);
        //获取商品数据
        $where=[
            'is_up'=>1
        ];
        $where['user_id']=$user_id;
        $where['cart_status']=1;
        $goodsinfo=DB::table('fx_goods')
            ->join('fx_cart', 'fx_goods.goods_id', '=', 'fx_cart.goods_id')
            ->where($where)
            ->whereIn('fx_goods.goods_id',$goods_id)
            ->get();
        $order_amount=0;
        foreach($goodsinfo as $k=>$v){
            $order_amount+=$v->self_price*$v->buy_number;
        }
        $orderinfo['order_amount']=$order_amount;
        $orderinfo['pay_type']=$pay_type;
        $orderinfo['user_id']=$user_id;
        $res=DB::table('fx_order')->insert($orderinfo);
        if($res!=true){
            $arr=[
                'code'=>2,
                'font'=>'提交失败'
            ];
            return json_encode($arr);die;
        }

        /*订单商品信息 存入订单详情表*/
        $order_id = DB::getPdo('fx_order')->lastInsertId();
        foreach($goodsinfo as $k=>$v){
            $info=[
                'goods_id'=>$v->goods_id,
                'user_id'=>$v->user_id,
                'buy_number'=>$v->buy_number,
                'self_price'=>$v->self_price,
                'goods_img'=>$v->goods_img,
                'goods_name'=>$v->goods_name,
            ];
            $info['order_id']=$order_id;
            $info['user_id']=$user_id;
            $order_detail=DB::table('fx_order_detail');
            $res1=$order_detail->insert($info);
            if($res1){
                session('order_id',$order_id);
                //删除购物车
                $res4=DB::table('fx_cart')->where('cart_id',$v->cart_id)->update(['cart_status'=>2]);
                //减少商品库存
                $res5=DB::table('fx_goods')->where('goods_id',$v->goods_id)->update(['goods_num'=>$v->goods_num-$v->buy_number]);
            }else{
                $arr=[
                    'code'=>2,
                    'font'=>'提交失败'
                ];
                return json_encode($arr);die;
            }
        }
        //地址添加
        $address=DB::table('fx_area')->where(['address_id'=>$address_id])->get();
        foreach($address as $k=>$v){
            $addinfo=[
                'address_name'=>$v->address_name,
                'address_tel'=>$v->address_tel,
                'address_detail'=>$v->address_detail,
                'province'=>$v->province,
                'city'=>$v->city,
                'area'=>$v->area,
            ];
            $addinfo['user_id']=$user_id;
            $addinfo['order_id']=$order_id;
            $res3=DB::table('fx_order_address')->insert($addinfo);
            if($res3!=true){
                $arr=[
                    'code'=>2,
                    'font'=>'提交失败'
                ];
                return json_encode($arr);die;
            }
        }
        if($res=='true'){
            session(['order' => ['order_id' =>$order_id]]);
            $arr=[
                'code'=>1,
                'font'=>'提交成功'
            ];
            return json_encode($arr);die;
        }else{
            $arr=[
                'code'=>2,
                'font'=>'提交失败'
            ];
            return json_encode($arr);die;
        }
    }
    public function success(Request $request){
        $order_id=session('order.order_id');
        $orderwhere = [
            'order_id'=>$order_id
        ];
        $order_model = new \App\Order;
        $res = $order_model->where($orderwhere)->first()->toArray();
        return view('Index/success',compact('res'));
    }

    //用户
    public function user()
    {
        $goods_model = new \App\Login;

        return view('Index/user');
    }




}
