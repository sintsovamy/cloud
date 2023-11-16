<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Actions\RegAction;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\RegisterValidationException;

class RegisterController extends Controller
{
    public function signup(
        RegisterRequest $request,
        RegAction $action,
    )
    {    
        $validated = $request->validated();
        
	$user = $action->handle($validated);

        $token = $user->createToken('user_token')->plainTextToken;

	return response()->json([
		'succees' => true,
		'code' => 201,
		'message' => 'Success',
                'user_token' => $token], 201);
    }

}
