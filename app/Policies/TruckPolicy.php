<?php

namespace App\Policies;

use App\Models\Truck;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TruckPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
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
    public function update(User $user, Truck $truck): bool
    {
        return $user->role->name === 'مدير';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Truck $truck): bool
    {
        return $user->role->name === 'مدير';
    }

    public function MultiDelete(User $user): bool
    {
        return $user->role->name === 'مدير';
    }

   
}
