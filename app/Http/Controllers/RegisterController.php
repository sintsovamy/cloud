<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function signup(RegisterRequest $request)
    {    
        $validated = $request->validated();

	//if ($validator->fails()) {
	//	return response()->json([
	//		'success' => false,
	//		'code' => 422,
	//		'errors' => $validator->errors()], 422);
	//}

	$user = User::create([
	    'email' => $request->email,
	    'password' => bcrypt($request->password),
            'first_name' => $request->first_name,
	    'last_name' => $request->last_name,
	]);

	$token = $user->createToken('user_token')->plainTextToken;
	return response()->json([
		'succees' => true,
		'code' => 201,
		'message' => 'Success',
                'user_token' => $token], 201);
    }

}
