<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function signup(Request $request)
    {    
	/* ВАЛИДАЦИЯ ПОЛЕЙ */
       
	$user = User::create([
	    'email' => $request->email,
	    'password' => md5($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
	]);

	$token = $user->createToken('bearer_token')->plainTextToken;

	return response()->json([
		'succees' => true,
		'code' => 201,
		'message' => 'Success',
                'bearer_token' => $token], 201);
    }

}
