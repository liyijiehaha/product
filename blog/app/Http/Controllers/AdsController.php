<?php

namespace App\Http\Controllers;

use App\Ads;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdsPost;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {

        $model = new ads;

        $query = request()->input();
        // dd($query);
        //搜索条件
        $where = [];
        if(isset($query['ads_name'])?$query['ads_name']:''){
            $where[]=['ads_name','like',"%$query[ads_name]%"];
        }
        $data = $model->where($where)->paginate(2);
        // dd($data);

        return view('Ads/index',compact('data','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Ads/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdsPost $request)
    {
        $data = request()->all();
        // dd($data);4
        $ads = new Ads;
        $ads['ads_logo']=$this->adslogo($request,'ads_logo');
        $ads->ads_name = $request->ads_name;
        $ads->ads_ci = $request->ads_ci;
        $ads->ads_desc = $request->ads_desc;
        $ads->ads_show = $request->ads_show;
        $ads->save();

        // dd($ads->ads_show );

    }




    public function adslogo(Request $request,$ads_logo){
        if ($request->hasFile($ads_logo) && $request->file($ads_logo)->isValid()) {
            $photo = $request->file($ads_logo);
            $ads_logo = "adslogo/";
            $store_result = $photo->store($ads_logo.date('Ymd'));
            return trim($store_result,$ads_logo);
        }
        exit('未获取到上传文件或上传过程出错');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $model = new ads;
        $ads_id = request()->input('ads_id');
        // dd($ads_id);
        $data = $model->find($ads_id)->toArray();
        // var_dump($data);die;
        
        return view('Ads/edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $model = new ads;
        $data=$request->all();
        $data['ads_logo']=$this->adslogo($request,'ads_logo');
        unset($data['_token']);
        $data = $model->where('ads_id',$data['ads_id'])->update($data);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $model = new ads;
        $ads_id = request()->input('ads_id');
        // dd($ads_id);
        $data = $model->where('ads_id',$ads_id)->delete();
        
    }
}
