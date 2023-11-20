<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CustomValidationException extends ValidationException
{
    public function render($request): JsonResponse
    {
        return new JsonResponse([
		'success' => false,
		'code' => 422,
		'message' => $this->validator->errors()->getMessages(),
	], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
   
}
