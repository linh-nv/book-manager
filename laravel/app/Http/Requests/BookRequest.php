<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        $bookId = $this->route('book') ? $this->route('book')->id : null;

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:books,slug,' . $bookId,
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rear_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
            'price' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'Tên sách là bắt buộc.',
            'name.string' => 'Tên sách phải là một chuỗi ký tự.',
            'name.max' => 'Tên sách không được vượt quá 255 ký tự.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.string' => 'Slug phải là một chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1.',
            'description.string' => 'Mô tả phải là một chuỗi ký tự.',
            'front_image.max' => 'Đường dẫn quá dài.',
            'front_image.image' => 'The front image must be an image.',
            'front_image.mimes' => 'The front image must be a file of type: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'Đường dẫn quá dài.',
            'thumbnail.image' => 'The front image must be an image.',
            'thumbnail.mimes' => 'The front image must be a file of type: jpeg, png, jpg, gif.',
            'rear_image.max' => 'Đường dẫn quá dài.',
            'rear_image.image' => 'The front image must be an image.',
            'rear_image.mimes' => 'The front image must be a file of type: jpeg, png, jpg, gif.',
            'category_id.required' => 'Thể loại là bắt buộc.',
            'category_id.exists' => 'Thể loại không tồn tại.',
            'author_id.required' => 'Tác giả là bắt buộc.',
            'author_id.exists' => 'Tác giả không tồn tại.',
            'publisher_id.required' => 'Nhà xuất bản là bắt buộc.',
            'publisher_id.exists' => 'Nhà xuất bản không tồn tại.',
            'price.required' => 'Giá là bắt buộc.',
            'price.integer' => 'Giá phải là một số nguyên.',
            'price.min' => 'Giá không được nhỏ hơn 0.',
        ];
    }

    public function prepereForValidation()
    {
        $this->merge([
           'updated_at' => now(), 
        ]);
    }
}
