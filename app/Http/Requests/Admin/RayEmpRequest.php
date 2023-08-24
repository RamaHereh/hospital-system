<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RayEmpRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    { 
        $id = $this->route('ray_emp'); 
        return [
            "email" => 'required|email|unique:ray_emps,email,' . $id,
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
            'email.required' => 'يرجى إخال البريد الإلكتروني لموظف الأشعة',
            'email.email' => 'صيغة البريد الإلكتروني خاطئة يرجى إعادة إدخاله',
            'email.unique' => 'البريد الإلكتروني يجب أن يكون فريد يرجى إعادة إدخاله',
            'password.required' => 'يرجى إدخال كلمة السر',
            'phone.required' => 'يرجى إدخال رقم الهاتف الخاص بموظف الأشعة',
            'phone.numeric' => 'رقم الهاتف مكون من أرقام فقط يرجى إعادة إدخاله',
            'phone.unique' =>' رقم الهاتف يجب أن يكون فريد يرجى إعادة إدخاله',
            'name.required' => 'يرجى إدحال اسم موظف الأشعة',
            'name.regex' =>'صيغة الاسم خاطئة يرجى إعادة إدخاله',
            
        ];
    }

}
