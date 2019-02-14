<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:employees',
            'password' => 'required|min:6',
            'email' => 'email|unique:employees',
            'birth_date' => 'nullable|date_format:"Y-m-d"',
        ];
    }
}
