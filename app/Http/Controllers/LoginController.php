<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function seen()
    {
        return 'Страница логина';
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['bearer_token' => $request->token]);
    
}
