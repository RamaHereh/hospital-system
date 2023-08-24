<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class AmbulanceRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'car_number' => 'required|numeric',
            'car_model' =>'required',
            'car_year_made' =>'required|numeric',
            'car_type' => "required|in:1,2",
            'driver_name' => 'required|unique:ambulance_translations' . $this->id,
            'driver_license_number' =>'required|numeric',
            'driver_phone' =>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'car_number.required' => trans('validation.required'),
            'car_model.required' => trans('validation.required'),
            'car_year_made.required' => trans('validation.required'),
            'car_year_made.numeric' => trans('validation.numeric'),
            'car_type.required' => trans('validation.required'),
            'driver_name.required' => trans('validation.required'),
            'driver_name.unique' => trans('validation.unique'),
            'driver_license_number.required' => trans('validation.required'),
            'driver_license_number.numeric' => trans('validation.numeric'),
            'driver_phone.required' => trans('validation.required'),
            'driver_phone.numeric' => trans('validation.numeric'),
        ];
    }
}
