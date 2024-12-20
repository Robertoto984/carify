<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEscortRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'الاسم الأول مطلوب',
            'last_name.required' => 'الكنية مطلوبة',
            'birth_date.required' => 'تاريخ الميلاد مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'address.required' => 'العنوان مطلوب',
            'birth_date.date_format' => 'يجب أن يكون تاريخ الميلاد بالصيغة يوم/شهر/سنة',
        ];
    }
}
