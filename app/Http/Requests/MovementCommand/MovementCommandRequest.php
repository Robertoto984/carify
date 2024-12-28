<?php

namespace App\Http\Requests\MovementCommand;

use Illuminate\Foundation\Http\FormRequest;

class MovementCommandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'number.*' => 'required',
            'date.*' => 'required',
            'responsible.*' => 'required',
            'truck_id.*' => 'required',
            'driver_id.*' => 'required',
            'escort_id.*' => 'nullable',
            'destination.*' => 'required',
            'task_start_time.*' => 'required',
            'task_end_time.*' => 'nullable',
            'initial_odometer_number.*' => 'nullable|integer',
            'final_odometer_number.*' => 'nullable|integer',
            'distance.*' => 'nullable|integer',
            'task.*' => 'required',
            'notes.*' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'number.*.required' => ' حقل الرقم مطلوب',
            'date.*.required' => 'حقل التارخ مطلوب',
            'responsible.*.required' => 'حقل الجهة المسؤولة مطلوب',
            'truck_id.*.required' => 'حقل رقم السيارة مطلوب',
            'driver_id.*.required' => 'حقل السائق مطلوب',
            'destination.*.required' => 'حقل وجهة التنقل مطلوب',
            'task_start_time.*.required' => 'حقل توقيت البدء مطلوب',
            'initial_odometer_number.*.integer' => 'حقل العداد عند البدء ارقام',
            'final_odometer_number.*.integer' => 'حقل العداد عند الانتهاء ارقام',
            'distance.*.required' => 'حقل المسافة المقطوعة مطلوب',
            'distance.*.integer' => 'حقل المسافة المقطوعة ارقام',
            'task.*.required' => 'حقل المهمة مطلوب',


        ];
    }
}
