<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class IndividualRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|unique:individual_translations' . $this->id,
            'price' => 'numeric|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى إدخال اسم الخدمة',
            'name.unique' => 'يجب أن يكون اسم الخدمة فريد يرجى إعادة إدخاله',
            'price.required' => 'يرجى إخال سعر الخدمة',
            'price.numeric' => 'يجب أن يكون السعر مكون من أرقام فقط',
        ];
    }
}
