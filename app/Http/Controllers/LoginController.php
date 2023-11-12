<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
	$validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password]))
        {
            $user = Auth::user();
            $token = $user->createToken('user_token')->plainTextToken;
	    return response()->json([
		    'success' => true,
		    'code' => 200,
		    'message' => 'Success', 
		    'user_token'=> $token
	    ], 200);
	} else {
            return response()->json([
		    'success' => false,
		    'code' => 401,
		    'message' => 'Authorization failed'
	    ], 401);
	}
    }
}
