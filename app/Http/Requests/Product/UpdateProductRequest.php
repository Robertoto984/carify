<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required',
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'origin_country' => 'required',
            'prod_date' => 'nullable',
            'exp_date' => 'nullable',
            'supplier_id' => 'required',
            'notes' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'الرمز مطلوب',
            'name.required' => 'الاسم مطلوب',
            'qty.required' => 'الكمية مطلوبة',
            'price.required' => 'الكمية مطلوبة',
            'origin_country.required' => 'بلد المنشأ مطلوب    ',
            'qty.float' => 'يجب أن تكون الكمية رقماَ',
            'price.float' => 'يجب أن تكون الكمية رقماَ',
            'supplier_id.required' => 'المورّد مطلوب'
        ];
    }
}
