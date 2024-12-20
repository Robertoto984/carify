<?php

namespace App\Policies;

use App\Models\Escort;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EscortPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): bool
    {
        return $user->role->name === 'مدير';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function create(User $user): bool
    {
        return $user->role->name === 'مدير';
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Escort $escort): bool
    {
        return $user->role->name === 'مدير';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Escort $escort): bool
    {
        return $user->role->name === 'مدير';
    }

    public function MultiDelete(User $user): bool
    {
        return $user->role->name === 'مدير';
    }
}
