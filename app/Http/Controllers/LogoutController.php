<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\LogoutAction;

class LogoutController extends Controller
{
    public function logout(
	LogoutAction $action
    )
    {
        $action->handle();

	return response()->json([], 204);
    }
}
