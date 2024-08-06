<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LendTicketRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {

        return [
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|integer|in:1,2,3',
            'note' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        
        return [
            'user_id.required' => 'ID người dùng là bắt buộc.',
            'user_id.exists' => 'ID người dùng không tồn tại.',
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu phải là ngày hợp lệ.',
            'end_date.required' => 'Ngày kết thúc là bắt buộc.',
            'end_date.date' => 'Ngày kết thúc phải là ngày hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.integer' => 'Sai kiểu dữ liệu.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'note.string' => 'Ghi chú phải là một chuỗi ký tự.',
            'note.max' => 'Ghi chú quá dài, không được vượt quá 255 ký tự.',
        ];
    }
    
    public function prepereForValidation()
    {
        $this->merge([
           'updated_at' => now(), 
        ]);
    }
}
