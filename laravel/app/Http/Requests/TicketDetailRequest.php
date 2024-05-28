<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketDetailRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {

        return [
            'book_id' => 'required|exists:books,id',
            'lend_ticket_id' => 'required|exists:lend_tickets,id',
            'return_date' => 'nullable|date',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|integer|in:1,2,3,4',
        ];
    }

    public function messages()
    {

        return [
            'book_id.required' => 'ID sách là bắt buộc.',
            'book_id.exists' => 'ID sách không tồn tại.',
            'lend_ticket_id.required' => 'ID phiếu mượn là bắt buộc.',
            'lend_ticket_id.exists' => 'ID phiếu mượn không tồn tại.',
            'return_date.date' => 'Ngày trả phải là ngày hợp lệ.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1.',
            'status.integer' => 'Sai kiểu dữ liệu.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
    
    public function prepereForValidation()
    {
        $this->merge([
           'updated_at' => now(), 
        ]);
    }
}
