<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\MaintenanceRequest;

class MaintenanceRequestPolicy
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
    public function update(User $user, MaintenanceRequest $m): bool
    {
        return $user->role->name === 'مدير';
    }

    public function delete(User $user, MaintenanceRequest $m): bool
    {
        return $user->role->name === 'مدير';
    }
    public function MultiDelete(User $user): bool
    {
        return $user->role->name === 'مدير';
    }
}
