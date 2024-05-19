<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên tác giả là bắt buộc.',
            'name.string' => 'Tên tác giả phải là một chuỗi ký tự.',
            'name.max' => 'Tên tác giả quá dài.',
        ];
    }

    public function prepereForValidation()
    {
        $this->merge([
           'updated_at' => now(), 
        ]);
    }
}
