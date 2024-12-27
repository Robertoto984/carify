<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable',
            'trade_name' => 'nullable',
            'address' => 'required',
            'email' => 'nullable',
            'phone_1' => 'required',
            'phone_2' => 'nullable',
            'notes' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'address.*.required' => 'العنوان مطلوب',
            'phone_1.*.required' => 'رقم الهاتف مطلوب',
        ];
    }
}
