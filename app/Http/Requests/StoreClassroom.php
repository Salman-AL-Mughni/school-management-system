<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'List_Classes.*.Name' => 'required',//هذا الكود يقول انو فيه class اسمه list classes بداخله name يعني * تعبر عن array وبداخلهاا قيم
            'List_Classes.*.Name_class_en' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name_class_en.required' => trans('validation.required'),
        ];
    }
}
