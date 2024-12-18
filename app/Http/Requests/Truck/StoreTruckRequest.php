<?php

namespace App\Http\Requests\Truck;

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
            'type' => 'required|array',
            'manufacturer' => 'required|array',
            'plate_number' => 'required|array',
            'chassis_number' => 'required|array',
            'engine_number' => 'required|array',
            'traffic_license_number' => 'required|array',
            'legal_status' => 'required|array',
            'fuel_type' => 'required|array',
            'year' => 'required|array',
            'model' => 'required|array',
            'passengers_number' => 'required|array',
            'gross_weight' => 'required|array',
            'empty_weight' => 'required|array',
            'load' => 'required|array',
            'kilometer_number' => 'required|array',
            'technical_status' => 'required|array',
            'color' => 'required|array',
            'register' => 'required|array',
            'demarcation_date' => 'required|array',
            'parts_description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'النوع مطلوب',
            'manufacturer.required' => 'الصانع مطلوب',
            'plate_number.required' => 'رقم اللوحة مطلوب',
            'chassis_number.required' => 'رقم الشاسيه مطلوب',
            'engine_number.required' => 'رقم المحرك مطلوب',
            'traffic_license_number.required' => 'رقم رخصة السير مطلوب',
            'legal_status.required' => 'الحالة القانونية مطلوبة',
            'fuel_type.required' => 'نوع الوقود مطلوب',
            'year.required' => 'السنة مطلوبة',
            'model.required' => 'الموديل مطلوب',
            'passengers_number.required' => 'عدد الركاب مطلوب',
            'gross_weight.required' => 'الوزن القائم مطلوب',
            'empty_weight.required' => 'الوزن الفارغ مطلوب',
            'load.required' => 'الحمولة مطلوبة',
            'kilometer_number.required' => 'رقم العداد مطلوب',
            'technical_status.required' => 'الحالة الفنية مطلوبة',
            'color.required' => 'اللون مطلوب',
            'register.required' => 'التجسيل مطلوب',
            'demarcation_date.required' => 'تاريخ الترسيم مطلوب',
        ];
    }
}
