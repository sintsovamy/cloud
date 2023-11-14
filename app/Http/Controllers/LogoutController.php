<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
	$user = Auth::user();
	$user->tokens()->delete();

	return response()->json([], 204);
    }
}
