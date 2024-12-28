<?php

namespace App\Policies;

use App\Models\MaintenanceOrder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MaintenanceOrderPolicy
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
     * Determine whether the user can view the model.
     */
    public function create(User $user): bool
    {
        return $user->role->name === 'مدير';
    }

}
