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
            'type.*' => 'required',
            'manufacturer.*' => 'required',
            'plate_number.*' => 'required',
            'chassis_number.*' => 'required',
            'engine_number.*' => 'required',
            'traffic_license_number.*' => 'required',
            'legal_status.*' => 'required',
            'fuel_type.*' => 'required',
            'year.*' => 'required',
            'model.*' => 'required',
            'passengers_number.*' => 'required',
            'gross_weight.*' => 'required|numeric|min:0',
            'empty_weight.*' => 'required|numeric|min:0',
            'load.*' => 'required|numeric|min:0',
            'kilometer_number.*' => 'required|numeric|min:0',
            'technical_status.*' => 'required',
            'color.*' => 'required',
            'register.*' => 'required',
            'demarcation_date.*' => 'required',
            'parts_description.*'=> 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'type.*.required' => 'النوع مطلوب',
            'manufacturer.*.required' => 'الصانع مطلوب',
            'plate_number.*.required' => 'رقم اللوحة مطلوب',
            'chassis_number.*.required' => 'رقم الشاسيه مطلوب',
            'engine_number.*.required' => 'رقم المحرك مطلوب',
            'traffic_license_number.*.required' => 'رقم رخصة السير مطلوب',
            'legal_status.*.required' => 'الحالة القانونية مطلوبة',
            'fuel_type.*.required' => 'نوع الوقود مطلوب',
            'year.*.required' => 'السنة مطلوبة',
            'model.*.required' => 'الموديل مطلوب',
            'passengers_number.*.required' => 'عدد الركاب مطلوب',
            'passengers_number.*.integer' => 'عدد الركاب يجب ان يكون ارقام',
            'gross_weight.*.required' => 'الوزن القائم مطلوب',
            'empty_weight.*.required' => 'الوزن الفارغ مطلوب',
            'load.*.required' => 'الحمولة مطلوبة',
            'kilometer_number.*.required' => 'رقم العداد مطلوب',
            'kilometer_number.*.integer' => ' رقم العداد يجب ان يكون ارقام',
            'technical_status.*.required' => 'الحالة الفنية مطلوبة',
            'color.*.required' => 'اللون مطلوب',
            'register.*.required' => 'التسجيل مطلوب',
            'demarcation_date.*.required' => 'تاريخ الترسيم مطلوب',
            'gross_weight.*.numeric' => 'يجب أن يكون الوزن القائم رقماً',
            'empty_weight.*.numeric' => 'يجب أن يكون الوزن الفارغ رقماً',
            'load.*.numeric' => 'يجب أن تكون الحمولة رقماً',
            'kilometer_number.*.numeric' => 'يجب أن يكون رقم العداد رقماً',
        ];
    }

   
}
