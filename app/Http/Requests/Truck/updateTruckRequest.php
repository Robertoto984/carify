<?php

namespace App\Http\Requests\Truck;

use Illuminate\Foundation\Http\FormRequest;

class updateTruckRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            'type.required' => 'النوع مطلوب',
            'manufacturer.required' => 'الصانع مطلوب',
            'plate_number.required' => 'رقم اللوحة مطلوب',
            'chassis_number.required' => 'رقم الشاسيه مطلوب',
            'engine_number.required' => 'رقم المحرك مطلوب',
            'traffic_license_number.required' => 'رقم رخصة السير مطلوب',
            'legal_status.required' => 'الحالة القانونية مطلوب',
            'fuel_type.required' => 'نوع الوقود مطلوب',
            'year.required' => 'السنة مطلوبة',
            'model.required' => 'الموديل مطلوب',
            'passengers_number.required' => 'عدد الركاب مطلوب',
            'passengers_number.integer' => 'يجب أن يكون عدد الركاب رقماً',
            'gross_weight.numeric' => 'يجب أن يكون الوزن القائم رقماً',
            'empty_weight.numeric' => 'يجب أن يكون الوزن الفارغ رقماً',
            'gross_weight.required' => 'الوزن القائم مطلوب',
            'empty_weight.required' => 'الوزن الفارغ مطلوب',
            'load.numeric' => 'يجب أن تكون الحمولة رقماً',
            'load.required' => 'الحمولة مطلوبة',
            'kilometer_number.integer' => 'يجب أن رقم العداد رقماً',
            'kilometer_number.required' => 'رقم العداد مطلوب',
            'technical_status.required' => 'الحالة الفنية مطلوبة',
            'color.required' => 'اللون مطلوب',
            'register.required' => 'سنة التسجيل مطلوبة',
            'demarcation_date.required' => 'تاريخ الترسيم مطلوب',
        ];
    }
}
