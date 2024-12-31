<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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

    public function update(User $user, Product $product): bool
    {
        return $user->role->name === 'مدير';
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->role->name === 'مدير';
    }
    public function MultiDelete(User $user): bool
    {
        return $user->role->name === 'مدير';
    }
}
