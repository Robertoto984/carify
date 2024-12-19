<?php

namespace App\Http\Requests\Cards;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliverCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required',
            'manufacturer' => 'required',
            'plate_number' => 'required',
            'chassis_number' => 'required',
            'engine_number' => 'required',
            'traffic_license_number' => 'required',
            'legal_status' => 'required',
            'fuel_type' => 'required',
            'year' => 'required|date_format:Y',  // Specify a valid year format
            'model' => 'required|date_format:Y', // Similarly for model
            'register' => 'required|date_format:Y', // Ensure it's in year format
            'demarcation_date' => 'required|date_format:Y-m-d', // Full date format
            'passengers_number' => 'required',
            'gross_weight' => 'required',
            'empty_weight' => 'required',
            'load' => 'required',
            'kilometer_number' => 'required',
            'technical_status' => 'required',
            'color' => 'required',
            'receipt_date' => 'required',
            'deliver_date' => 'required',
            'driver_id' => 'required',
            'truck_id' => 'required',
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
            'driver_id.required' => 'السائق مطلوب',
            'truck_id.required' => ' معرف المركبة مطلوب',
            'register.required' => 'التجسيل مطلوب',
            'demarcation_date.required' => 'تاريخ الترسيم مطلوب',
            'deliver_date.required' => 'تاريخ التسليم مطلوب',
            'receipt_date.required' => 'تاريخ الاستلام مطلوب',
        ];
    }
}
