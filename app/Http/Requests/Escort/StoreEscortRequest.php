<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;

class StoreEscortRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'first_name.*' => 'required|string|max:255',
            'last_name.*' => 'required|string|max:255',
            'birth_date.*' => 'required|date',
            'phone.*' => 'required|string|max:15',
            'address.*' => 'required|string|max:255',
            'license_type.*' => 'nullable|string',
            'license_expiration_date.*' => 'nullable|date',
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
        ];
    }
}
