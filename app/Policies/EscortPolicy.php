<?php

namespace App\Policies;

use App\Models\Escort;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;


class EscortPolicy
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


    public function update(User $user, Escort $escort): bool
    {
        return $user->role->name === 'مدير';
    }

    public function delete(User $user, Escort $escort): bool
    {
        return $user->role->name === 'مدير';
    }

    public function MultiDelete(User $user): bool
    {
        return $user->role->name === 'مدير';
    }
}
