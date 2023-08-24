<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosisRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "diagnosis" => 'required',
            "medicine" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'diagnosis.required' => 'يرجى إدخال التشخيص',
            'medicine.required' => 'يرجى إدخال الأدوية المطلوبة',
 
        ];
    }

}
