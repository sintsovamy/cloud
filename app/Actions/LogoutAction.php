<?php

namespace App\Actions;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;

class LogoutAction
{
   // public function __construct(User $user)
   // {
   //     $this->user = $user;
   // }

    public function handle()
    {
	$user = Auth::user();
	$user->tokens()->delete();
    }
}
   
