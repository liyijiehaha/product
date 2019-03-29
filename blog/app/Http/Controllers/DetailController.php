<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail(Request $request)
    {
        $goods_model = new \App\Index;
        $goods_id = request()->input('goods_id');
        $data = $goods_model->find($goods_id)->toArray();
        $data['goods_imgs']=explode('|',rtrim($data['goods_imgs'],'|'));
        return view('Detail/detail',compact('data'));
    }

}
