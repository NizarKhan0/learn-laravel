<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name'=> 'max:50|required',
            'gender'=> 'required',
            'studid' => 'unique:students|max:8|required',
            'class_id'=> 'required'
        ];
    }

    public function attributes(){
        return [
            'name' => 'Name',
            'gender' => 'Gender',
            'studid' => 'Student ID',
            'class_id' => 'Class'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot empty!',
            'name.max' => 'Name maximal :max characters!',
            'gender.required' => 'Gender cannot empty!',
            'studid.required' => 'Student ID cannot empty!',
            'studid.max' => 'Student ID maximal :max characters!',
            'class_id.required' => 'Class cannot empty!'
        ];
    }
}