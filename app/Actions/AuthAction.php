<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthAction
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(array $attributes): User|null
    {
        if(Auth::attempt($attributes)) {
	     return $user = Auth::user();
	}  else { 
		return null;
	}
    }

}

