<?php

namespace App\Http\Requests;

use App\Http\Requests\AbstractRequest;

class UploadFileRequest extends AbstractRequest
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
		'file' => [
		'required',	
		 'file',
		'mimes:pdf,doc,docx,zip,jpeg,jpg,png',
		'max:2048'
	    ]
	];
    }

}
