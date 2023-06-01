<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:students,email',
            'gender' => 'required',
            'phone' => 'required|regex:/^[0-9]{10}$/|numeric',
            'address' => 'required',
            'dob' => 'required',
            'level' => 'array|required',
            'college' => 'array|required',
            'university' => 'array|required',
            'start_date' => 'array|required',
            'end_date' => 'array|required'
        ];
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['email'] = [
                'email',
                Rule::unique('students')->ignore($this->route('id')),
            ];
        }
        return $rules;

    }
}
