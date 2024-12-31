<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
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

    public function update(User $user, Supplier $supplier): bool
    {
        return $user->role->name === 'مدير';
    }

    public function delete(User $user, Supplier $supplier): bool
    {
        return $user->role->name === 'مدير';
    }
    public function MultiDelete(User $user): bool
    {
        return $user->role->name === 'مدير';
    }
}
