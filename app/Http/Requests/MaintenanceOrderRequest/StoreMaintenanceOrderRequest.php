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
            'number.*' => 'required',
            'date.*' => 'required',
            'type.*' => 'required',
            'created_by.*' => 'nullable',
            'truck_id.*' => 'required',
            'driver_id.*' => 'required',
            'notes.*' => 'nullable',
            'odometer_number.*' => 'required',
            'total.*' => 'required',
            'procedure_id.*' => 'required',
            'product_id.*' => 'required',
            'unit_price.*' => 'required',
            'total_price.*' => 'required',
            'quantity.*' => 'required',
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
            'procedure_id.*.required' => 'حقل الإجراء مطلوب',
            'product_id.*.required' => 'حقل المادة مطلوب',
            'unit_price.*.required' => 'حقل السعر مطلوب',
            'total_price.*.required' => 'حقل إجمالي المادة مطلوب',
            'quantity.*.required' => 'حقل الكمية مطلوب',
        ];
    }
}
