<?php

namespace App\Http\Requests;

class UserEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20|regex:/^\w+$/|unique:users,name,' . $this->user()->id,
            'email' => 'required|email|unique:users,email,' . $this->route('user')->id,
            'introduction' => 'max:80'
        ];
    }

    public function messages()
    {
        return [
            'introduction.max:80' => '简介最多不超过80个字符'
        ];
    }

    public function attributes()
    {
        return [
            'introduction' => '个人简介',
            'name' => '用户名'
        ];
    }
}
