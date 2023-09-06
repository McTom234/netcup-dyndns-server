<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function before(User|null $user, string $ability): null|bool
    {
        if (is_null($user) && User::count() === 0 && $ability === 'create') {
            return true;
        }
        if ($user && $user->is_admin) {
            return true;
        }
        return null;
    }
    public function viewAny(User $user): bool
    {
        return false;
    }
    public function view(User $user, User $userParameter): bool
    {
        return $user->id === $userParameter->id;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return $this->create($user);
    }

    public function delete(User $user): bool
    {
        return $this->create($user);
    }
}
