<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, File $file): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function createAccess(User $user, File $file): bool
    {
        return $user->id === $file->owner_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, File $file): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function deleteAccess(User $user, File $file): bool
    {
        return $user->id === $file->owner_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, File $file): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, File $file): bool
    {
        //
    }
}
