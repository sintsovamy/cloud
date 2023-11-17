<?php

namespace App\Http\Requests;

use App\Exceptions\RegisterValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:users,email|email:rfc,dns',
            'password' => 'required|min:3|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'first_name'=> 'required|min:2',
            'last_name' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new RegisterValidationException($validator);
    }
}
