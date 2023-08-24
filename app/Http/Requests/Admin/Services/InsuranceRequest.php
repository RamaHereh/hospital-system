<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'insurance_code' => 'required',
            'discount_percentage' =>'required|numeric',
            'Company_rate' =>'required|numeric',
            'name' => 'required|unique:insurance_translations',
        ];
    }

    public function messages()
    {
        return [
            'insurance_code.required' => trans('validation.required'),
            'discount_percentage.required' => trans('validation.required'),
            'discount_percentage.numeric' => trans('validation.numeric'),
            'Company_rate.required' => trans('validation.required'),
            'Company_rate.numeric' => trans('validation.numeric'),
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
        ];
    }
}
