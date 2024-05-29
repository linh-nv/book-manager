<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'user_code' => 'unique:users,user_code,' . $userId,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'password' => 'sometimes|required|string|min:6',
            'address' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'gender' => 'required|integer|in:0,1',
            'role_id' => 'integer|in:1,2',
        ];
    }

    public function messages()
    {
        return [

            'user_code.unique' => 'Mã người dùng đã tồn tại.',
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên quá dài, không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.string' => 'Email phải là một chuỗi ký tự.',
            'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'email.max' => 'Email quá dài, không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ quá dài, không được vượt quá 255 ký tự.',
            'tel.string' => 'Số điện thoại phải là một chuỗi ký tự.',
            'tel.max' => 'Số điện thoại quá dài, không được vượt quá 20 ký tự.',
            'birthday.date' => 'Phải là ngày hợp lệ.',
            'gender.required' => 'Giới tính là bắt buộc.',
            'gender.integer' => 'Sai kiểu dữ liệu.',
            'gender.in' => 'Giới tính không tồn tại.',
            'role_id.integer' => 'Sai kiểu dữ liệu.',
            'role_id.exists' => 'Role không tồn tại.',
        ];
    }
    
    public function prepereForValidation()
    {
        $this->merge([
           'updated_at' => now(), 
        ]);
    }
}
