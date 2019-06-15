<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsers extends FormRequest
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
            'number' => 'required|unique:users|regex:/^[a-zA-Z0-9]{4,16}$/',
            'ufile' => 'required',
            'email' => 'required',
            'pass' => 'required|regex:/^[\w]{6,18}/',
            'upass' => 'required|same:pass',
            'tel' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
        ];
    }

    /**
     * 自定义错误信息
     * @return [type] [description]
     */
    public function messages()
    {
        return[
            'number.required'=>'请输入用户名',
            'number.unique'=>'用户名已存在',
            'number.regex'=>'用户名格式错误',
            'email.required'=>'请输入邮箱',
            'upass.required'=>'请输入确认密码',
            'upass.same'=>'两次密码不一致',
            'tel.required'=>'请输入电话',
            'tel.regex'=>'手机号格式错误',
            'pass.regex'=>'密码格式错误',
            'pass.required'=>'请输入密码',
            'ufile.required'=>'请选择头像',
        ];

    }
}
