<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LaboratoryEmpRequest  extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('laboratory_emp'); 
        return [
            "email" => 'required|email|unique:laboratory_emps,email,' . $id,
            "name" => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
        ];
        if ($this->isMethod('post')) {
            
            $rules['password'] = 'required';
        } elseif ($this->isMethod('put')) {
           
            $rules['password'] = 'nullable';
        }
    }

    public function messages()
    {
        return [
            'email.required' => 'يرجى إخال البريد الإلكتروني لموظف المختبر',
            'email.email' => 'صيغة البريد الإلكتروني خاطئة يرجى إعادة إدخاله',
            'email.unique' => 'البريد الإلكتروني يجب أن يكون فريد يرجى إعادة إدخاله',
            'password.required' => 'يرجى إدخال كلمة السر',
            'name.required' => 'يرجى إدحال اسم موظف المختبر',
            'name.regex' =>'صيغة الاسم خاطئة يرجى إعادة إدخاله',
        ];
    }

}
