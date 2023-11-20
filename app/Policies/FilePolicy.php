<?php

namespace App\Policies;

use App\Models\User;
use App\Models\File;
use Illuminate\Auth\Access\Response;

class FilePolicy
{
    public function update(User $user, File $file): bool
    {
	    return $user->id === $file->user_id;

    }
}
