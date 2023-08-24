<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

  
    public function rules()
    {
        return [
            "email" => 'required|email|unique:patients,email,' . $this->id,
            "password" => 'required|sometimes',
            "phone" => 'required|numeric|unique:patients,phone,' . $this->id,
            "name" => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            "gender" => 'required',
            "blood_group" => 'required',
            "date_birth" => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'يرجى إخال البريد الإلكتروني للمريض ',
            'email.email' => 'صيغة البريد الإلكتروني خاطئة يرجى إعادة إدخاله',
            'email.unique' => 'البريد الإلكتروني يجب أن يكون فريد يرجى إعادة إدخاله',
            'password.required' => 'يرجى إدخال كلمة السر',
            'phone.required' => 'يرجى إدخال رقم الهاتف الخاص بالمريض ',
            'phone.numeric' => 'رقم الهاتف مكون من أرقام فقط يرجى إعادة إدخاله',
            'phone.unique' =>' رقم الهاتف يجب أن يكون فريد يرجى إعادة إدخاله',
            'name.required' => 'يرجى إدحال اسم المريض ',
            'name.regex' =>'صيغة الاسم خاطئة يرجى إعادة إدخاله',
            'gender.required' => 'يرجى تحديد جنس المريض ',
            'blood_group.required' => 'يرجى تحديد زمرة دم المريض ',
            'date_birth.required' => 'يرجى تحديد تاريخ ولادة المريض '
        ];
    }

}
