<?php

namespace App\Http\Requests\LaboratoryEmp;

use Illuminate\Foundation\Http\FormRequest;

class LaboratoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "description_employee" => 'required' ,
            "photos" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'description_employee.required' =>'يرجى تحديد التشخيص',
            'photos.required' => 'يرجى إدخال صورة التحليل',
        ];
    }

}
