<?php

namespace App\Policies;

use App\Models\MaintenanceTypes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaintenanceTypesPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->role->name === 'مدير';
    }

    public function create(User $user): bool
    {
        return $user->role->name === 'مدير';
    }

    public function update(User $user, MaintenanceTypes $maintenance_types): bool
    {
        return $user->role->name === 'مدير';
    }

    public function delete(User $user, MaintenanceTypes $maintenance_types): bool
    {
        return $user->role->name === 'مدير';
    }
    public function MultiDelete(User $user): bool
    {
        return $user->role->name === 'مدير';
    }
}
