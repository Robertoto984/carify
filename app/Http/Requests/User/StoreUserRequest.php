<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name.*'=>'required',
            'email.*'=>'required|unique:users,email,except,id',
            'role_id.*'=>'required',
            'password.*'=>'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'name.*.required'=>'الاسم مطلوب',
            'email.*.required'=>'البريد الالكتروني مطلوب',
            'email.*.unique'=>'البريد الالكتروني موجود',
            'password.*.required'=>'كلمة المرور مطلوبة',
            'password.*.min'=>'كلمة المرور يجب ان تكون أكبر من 5 محارف',
            'role_id.*.required'=>'الوظيفة مطلوبة'
        ];
    }
    
}
