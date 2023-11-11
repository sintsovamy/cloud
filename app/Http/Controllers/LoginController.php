<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password]))
        {
            $user = Auth::user();
            $token = $user->createToken('user_token')->accessToken;
	    return response()->json([
		    'success' => true,
		    'code' => 200,
		    'message' => 'Success', 
		    'token'=> $token->token
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
