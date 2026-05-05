<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmbulanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_number' => 'required|unique:ambulances,car_number',
            'car_model' => 'required',
            'car_year_made' => 'required|numeric',
            'car_type' => 'required|in:1,2',
            'drivers' => 'required|array|min:1',
            'drivers.*.driver_name' => 'required|string',
            'drivers.*.driver_license_number' => 'required|numeric|unique:ambulance_drivers,driver_license_number',
            'drivers.*.driver_phone' => 'required|numeric',
            'notes' => 'nullable|string',
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
            'drivers.required' => trans('validation.required'),
            'drivers.array' => trans('validation.array'),
            'drivers.min' => trans('validation.min.array'),
            'drivers.*.driver_name.required' => trans('validation.required'),
            'drivers.*.driver_name.string' => trans('validation.string'),
            'drivers.*.driver_license_number.required' => trans('validation.required'),
            'drivers.*.driver_license_number.numeric' => trans('validation.numeric'),
            'drivers.*.driver_phone.required' => trans('validation.required'),
            'drivers.*.driver_phone.numeric' => trans('validation.numeric'),
            'notes.string' => trans('validation.string'),
        ];
    }
}
