<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFriendly extends FormRequest
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
        // 验证规则
        return [
                'lname' => 'required|unique:friendly',
                'lurl' => 'required',
                'limg' => 'required',
                'lstatus' => 'required',
            ];
    }

    /**
     * 自定义 错误消息
     */
    public function messages()
    {
        return [
            'lname.required' => '链接名称必填',
            'lname.unique' => '该链接已存在',
            'lurl.required' => '跳转地址必填',
            'limg.required' => '展示图必选',
            'lstatus.required' => '状态必选',
        ];
    }
}
