<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function signup(Request $request)
    {    
	/* ВАЛИДАЦИЯ ПОЛЕЙ */
        $validator = Validator::make($request->all(), [
		'email' => 'required|unique:users,email|email:rfc,dns',
		'password' => 'required|min:3|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
		'first_name'=> 'required|min:2',
	        'last_name' => 'required'
	]);

	if ($validator->fails()) {
	    return response()->json(['errors' => $validator->errors()]);
	}
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
