<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'Tên nhà xuất bản là bắt buộc.',
            'name.string' => 'Tên nhà xuất bản phải là một chuỗi ký tự.',
            'name.max' => 'Tên nhà xuất bản không được vượt quá 255 ký tự.',
            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ];
    }
    
    public function prepereForValidation()
    {
        $this->merge([
           'updated_at' => now(), 
        ]);
    }
}
