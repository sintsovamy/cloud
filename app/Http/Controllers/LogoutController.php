<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(): void
    {
        //Auth::logout();
	return redirect()->route('/authorization');
    }
}
