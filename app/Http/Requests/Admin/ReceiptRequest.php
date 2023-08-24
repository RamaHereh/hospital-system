<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patient_id' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'يرجى تحديد اسم المريض',
        'name.amount' => 'يرجى إدخال الكمية المقبوضة',
        'name.description' => 'يرجى إدخال تفاصيل سند القبض',
    ];
}
}
