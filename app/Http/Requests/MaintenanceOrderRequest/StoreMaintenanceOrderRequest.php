<?php

namespace App\Http\Requests\MaintenanceOrderRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'number' => 'required',
            'date' => 'required',
            'type' => 'required',
            'created_by' => 'nullable',
            'truck_id' => 'required',
            'driver_id' => 'required',
            'notes' => 'nullable',
            'odometer_number' => 'required',
            'total' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'number.*.required' => ' حقل الرقم مطلوب',
            'date.*.required' => 'حقل التارخ مطلوب',
            'created_by.*.required' => 'حقل القائم بالصيانة مطلوب',
            'truck_id.*.required' => 'حقل رقم السيارة مطلوب',
            'driver_id.*.required' => 'حقل السائق مطلوب',
            'odometer_number.*.required' => 'حقل رقم العداد مطلوب',
            'total.*.required' => 'حقل الإجمالي مطلوب',
        ];
    }
}
