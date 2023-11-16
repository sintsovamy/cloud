<?php

namespace App\Actions;

use App\Models\User;

class RegAction
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(array $attributes): User
    {
        return $this->user->create($attributes);
    }
}
