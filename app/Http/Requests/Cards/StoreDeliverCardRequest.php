<?php

namespace App\Http\Requests\Cards;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliverCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'plate_number' => 'required|string|max:255',
            'chassis_number' => 'required|string|max:255',
            'engine_number' => 'required|string|max:255',
            'traffic_license_number' => 'required|string|max:255',
            'legal_status' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|between:1900,2099',
            'model' => 'required|string|max:255',
            'passengers_number' => 'required|integer|min:0',
            'gross_weight' => 'required|numeric|min:0',
            'empty_weight' => 'required|numeric|min:0',
            'load' => 'required|numeric|min:0',
            'kilometer_number' => 'required|numeric|min:0',
            'technical_status' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'register' => 'required',
            'demarcation_date' => 'required|date_format:Y-m-d',
            'receipt_date' => 'required|date_format:Y-m-d',
            'deliver_date' => 'required|date_format:Y-m-d',
            'driver_id' => 'required|exists:drivers,id',
            'truck_id' => 'required|exists:trucks,id',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'النوع مطلوب.',
            'manufacturer.required' => 'الصانع مطلوب.',
            'plate_number.required' => 'رقم اللوحة مطلوب.',
            'chassis_number.required' => 'رقم الشاسيه مطلوب.',
            'engine_number.required' => 'رقم المحرك مطلوب.',
            'traffic_license_number.required' => 'رقم رخصة السير مطلوب.',
            'legal_status.required' => 'الحالة القانونية مطلوبة.',
            'fuel_type.required' => 'نوع الوقود مطلوب.',
            'year.required' => 'السنة مطلوبة.',
            'model.required' => 'الموديل مطلوب.',
            'passengers_number.required' => 'عدد الركاب مطلوب.',
            'gross_weight.required' => 'الوزن القائم مطلوب.',
            'gross_weight.numeric' => 'يجب أن يكون الوزن القائم رقماً',
            'empty_weight.numeric' => 'يجب أن يكون الوزن الفارغ رقماً',
            'empty_weight.required' => 'الوزن الفارغ مطلوب.',
            'load.numeric' => 'يجب أن تكون الحمولة رقماً',
            'load.required' => 'الحمولة مطلوبة.',
            'kilometer_number.numeric' => 'يجب أن يكون رقم العداد رقماً',
            'kilometer_number.required' => 'رقم العداد مطلوب.',
            'technical_status.required' => 'الحالة الفنية مطلوبة.',
            'color.required' => 'اللون مطلوب.',
            'register.required' => 'التسجيل مطلوب.',
            'demarcation_date.required' => 'تاريخ الترسيم مطلوب.',
            'receipt_date.required' => 'تاريخ الاستلام مطلوب.',
            'deliver_date.required' => 'تاريخ التسليم مطلوب.',
            'driver_id.required' => 'السائق مطلوب.',
            'truck_id.required' => 'معرف المركبة مطلوب.',
        ];
    }
}
