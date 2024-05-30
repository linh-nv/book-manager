<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'slug' => ['required|string|max:255|unique:categories,slug,' , Rule::unique('categories', 'slug')->ignore($this->slug)],
        ];
    }


    public function messages()
    {

        return [
            'name.required' => 'Tên thể loại là bắt buộc.',
            'name.string' => 'Tên thể loại phải là một chuỗi ký tự.',
            'name.max' => 'Tên thể loại không được vượt quá 255 ký tự.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.string' => 'Slug phải là một chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại.',
        ];
    }
    
    public function prepereForValidation()
    {
        $this->merge([
           'updated_at' => now(), 
        ]);
    }
}
