<?php

namespace App\Http\Requests\MovementCommand;

use Illuminate\Foundation\Http\FormRequest;

class MovementCommandRequest extends FormRequest
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
            'number.*'=>'required',
            'date.*'=>'required',
            'responsible.*'=>'required',
            'truck_id.*'=>'required',
            'driver_id.*'=>'required',
            'escort_id.*'=>'required',
            'destination.*'=>'required',
            'task_start_time.*'=>'required',
            'task_end_time.*'=>'required',
            'initial_odometer_number.*'=>'required|integer',
            'final_odometer_number.*'=>'required|integer',
            'distance.*'=>'required|integer',
            'task.*'=>'required',
            'notes.*'=>'nullable',
        ];
    }

    public function messages()
    {
        return [
            'number.*.required'=>' حقل الرقم مطلوب',
            'date.*.required'=>'حقل التارخ مطلوب',
            'responsible.*.required'=>'حقل الجهة المسؤولة مطلوب',
            'truck_id.*.required'=>'حقل رقم السيارة مطلوب',
            'driver_id.*.required'=>'حقل السائق مطلوب',
            'escort_id.*.required'=>'حقل المرافق مطلوب',
            'destination.*.required'=>'حقل وجهة التنقل مطلوب',
            'task_start_time.*.required'=>'حقل توقيت البدء مطلوب',
            'task_end_time.*.required'=>'حقل توقيت الانتهاء مطلوب',
            'initial_odometer_number.*.required'=>'حقل العداد عند البدء مطلوب',
            'initial_odometer_number.*.integer'=>'حقل العداد عند البدء ارقام',
            'final_odometer_number.*.required'=>'حقل العداد عند الانتهاء مطلوب',
            'final_odometer_number.*.integer'=>'حقل العداد عند الانتهاء ارقام',
            'distance.*.required'=>'حقل المسافة المقطوعة مطلوب',
            'distance.*.integer'=>'حقل المسافة المقطوعة ارقام',
            'task.*.required'=>'حقل المهمة مطلوب',
            // 'notes.*.required'=>'حقل الملاحظات مطلوب',

        ];
    }
}
