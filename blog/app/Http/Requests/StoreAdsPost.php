<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdsPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>[
                'required',
                'regex:/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u',
            ],
            'ads_name' => 'required|max:255',
            'ads_ci' => 'required',
        ];


      
    }
    public function messages()
    {
        return [
            'ads_name.required' => '标题不能为空',
            'ads_ci.required' => '关键词不能为空',

        ];


      
    }
}
