<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class RayRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "description" => 'required' ,
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'يرجى تحديد المطلوب من موظف الأشعة',
        ];
    }

}
