<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
 
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "email" => 'required|email|unique:doctors,email,' . $this->id,
            "password" => 'required|min:6|sometimes',
            "phone" => 'required|numeric|unique:doctors,phone,' . $this->id,
            "name" => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            "appointments" => 'required',
            "section_id" => 'required',
            "photo" => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'يرجى إخال البريد الإلكتروني للطبيب ',
            'email.email' => 'صيغة البريد الإلكتروني خاطئة يرجى إعادة إدخاله',
            'email.unique' => 'البريد الإلكتروني يجب أن يكون فريد يرجى إعادة إدخاله',
            'password.required' => 'يرجى إدخال كلمة السر',
            'phone.required' => 'يرجى إدخال رقم الهاتف الخاص  بالطبيب',
            'phone.numeric' => 'رقم الهاتف مكون من أرقام فقط يرجى إعادة إدخاله',
            'phone.unique' =>' رقم الهاتف يجب أن يكون فريد يرجى إعادة إدخاله',
            'name.required' => 'يرجى إدخال اسم الطبيب ',
            'name.regex' =>'صيغة الاسم خاطئة يرجى إعادة إدخاله',
            'appointments.required' => 'يرجى تحديد مواعيد الطبيب ',
            'section_id.required' => 'يرجى تحديد قسم الطبيب ',
            'photo.required' => 'يرجى إدخال صورة الطبيب',
            'photo.image' => 'صورة الطبيب غير صالحة يرجى إعادة إدخالها'
        ];
    }

}
