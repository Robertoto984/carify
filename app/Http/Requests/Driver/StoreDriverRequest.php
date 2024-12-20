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
            'first_name.*' => 'required|string',
            'last_name.*' => 'required|string',
            'birth_date.*' => 'required',
            'phone.*' => 'required|string|max:15',
            'address.*' => 'required|string',
            'license_type.*' => 'required',
            'license_expiration_date.*' => 'required',
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
            'license_expiration_date.*.required'=>' تاريخ انتهاء الشهادة مطلوب',
            'license_expiration_date.*.date_format' => 'يجب أن يكون تاريخ انتهاء الشهادة بالصيغة يوم/شهر/سنة',
        ];
    }
}
