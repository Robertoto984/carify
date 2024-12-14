<?php

namespace App\Http\Requests\Truck;

use App\Enums\Color;
use App\Enums\FuelTypes;
use Illuminate\Foundation\Http\FormRequest;

class StoreTruckRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
         return [
            'type' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:9999',
            'register' => 'required|integer',
            'model' => 'required|integer',
            'plate_number' => 'required|integer',
            'chassis_number' => 'required|integer',
            'engine_number' => 'required|integer',
            'traffic_license_number' => 'required|integer',
            'demarcation_date' => 'required|date',
            'color' => ['required', 'string', 'in:' . implode(',', Color::values())],
            'fuel_type' => ['required', 'string', 'in:' . implode(',', FuelTypes::values())],
            'passengers_number' => 'required|string',
            'gross_weight' => 'required|string',
            'empty_weight' => 'required|string',
            'load' => 'required|string',
            'kilometer_number' => 'nullable|string',
            'parts_description' => 'nullable|string',
            'technical_status' => 'required|string',
            'legal_status' => 'required|string',
        ];
    }
}
