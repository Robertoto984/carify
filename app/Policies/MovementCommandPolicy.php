<?php

namespace App\Policies;

use App\Models\MovementCommand;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MovementCommandPolicy
{
    
    use HandlesAuthorization;
      /**
     * Determine whether the user can index models.
     */
    public function index(User $user): bool
    {
        return $user->role->name === 'مدير';
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->name === 'مدير';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MovementCommand $movementcommand): bool
    {
        return $user->role->name === 'مدير';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MovementCommand $movementcommand): bool
    {
        return $user->role->name === 'مدير';
    }

    public function MultiDelete(User $user): bool
    {
        return $user->role->name === 'مدير';
    }
    
    public function complete(User $user, MovementCommand $movementcommand)
    {
        return $user->role->name === 'مدير';

    }
}
