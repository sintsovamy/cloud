<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Actions\AuthAction;

class LoginController extends Controller
{
    public function login(
        LoginRequest $request,
	AuthAction $action
    )
    {
        $validated = $request->validated();
        
	$user = $action->handle($validated);

	if ($user) {
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

    public function index()
    {
            return view('login');
    }

}
