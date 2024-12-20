<?php

namespace App\Http\Requests\Truck;

use Illuminate\Foundation\Http\FormRequest;

class updateTruckRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'type' => 'required|string',
            'manufacturer' => 'required|string',
            'plate_number' => 'required|string',
            'chassis_number' => 'required|string',
            'engine_number' => 'required|string',
            'traffic_license_number' => 'required|string',
            'legal_status' => 'required|string',
            'fuel_type' => 'required|string',
            'year' => 'required',
            'model' => 'required|string',
            'passengers_number' => 'required|integer',
            'gross_weight' => 'required|numeric',
            'empty_weight' => 'required|numeric',
            'load' => 'required|numeric',
            'kilometer_number' => 'required|integer',
            'technical_status' => 'required|string',
            'color' => 'required|string',
            'register' => 'required',
            'demarcation_date' => 'required|date_format:Y-m-d',
            'parts_description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'The type field is required.',
            'manufacturer.required' => 'The manufacturer field is required.',
            'plate_number.required' => 'The plate number field is required.',
            'chassis_number.required' => 'The chassis number field is required.',
            'engine_number.required' => 'The engine number field is required.',
            'traffic_license_number.required' => 'The traffic license number field is required.',
            'legal_status.required' => 'The legal status field is required.',
            'fuel_type.required' => 'The fuel type field is required.',
            'year.required' => 'The year field is required.',
            'model.required' => 'The model field is required.',
            'passengers_number.required' => 'The number of passengers field is required.',
            'gross_weight.required' => 'The gross weight field is required.',
            'empty_weight.required' => 'The empty weight field is required.',
            'load.required' => 'The load field is required.',
            'kilometer_number.required' => 'The kilometer number field is required.',
            'technical_status.required' => 'The technical status field is required.',
            'color.required' => 'The color field is required.',
            'driver_id.required' => 'The driver field is required.',
            'register.required' => 'The register field is required.',
            'demarcation_date.required' => 'The demarcation date field is required.',
        ];
    }
}
