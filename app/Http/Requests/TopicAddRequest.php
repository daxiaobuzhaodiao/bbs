<?php

namespace App\Http\Requests;

class TopicAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|between:5,40',
            'category_id' => 'required|exists:categories,id|integer',
            'body' => 'required|min:3'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '标题',
            'category_id' => '分类',
            'body' => '内容'
        ];
    }
}
