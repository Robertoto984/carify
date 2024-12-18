<?php

namespace App\Http\Requests\Driver;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
         return [
            'first_name' => 'required|array|max:255',
            'last_name' => 'required|array|max:255',
            'birth_date' => 'required',
            'phone' => 'required|array|max:15',
            'address' => 'required|array|max:255',
            'license_type' => 'required|array',
            'license_expiration_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.*.required' => 'الاسم الأول مطلوب',
            'last_name.*.required' => 'الكنية مطلوبة',
            'birth_date.*.required' => 'تاريخ الميلاد مطلوب',
            'phone.*.required' => 'رقم الهاتف مطلوب',
            'address.*.required' => 'العنوان مطلوب',
            'license_type.*.required' => 'فئة الشهادة مطلوبة',
            'license_expiration_date.*.required' => 'تاريخ انتهاء الشهادة مطلوب',
            'birth_date.*.date_format' => 'يجب أن يكون تاريخ الميلاد بالصيغة يوم/شهر/سنة',
            'license_expiration_date.*.date_format' => 'يجب أن يكون تاريخ انتهاء الشهادة بالصيغة يوم/شهر/سنة',
        ];
    }
}
