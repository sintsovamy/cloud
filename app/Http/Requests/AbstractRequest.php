<?php

namespace App\Http\Requests;

use App\Exceptions\CustomValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AbstractRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new CustomValidationException($validator);
    }
}

