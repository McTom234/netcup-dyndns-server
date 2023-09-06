<?php

namespace App\Policies;

use App\Models\DomainName;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DomainNamePolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->is_admin) {
            return true;
        }
        return request()->has('filterUserId') && request()->query('filterUserId') === $user->id;
    }

    public function view(User $user, DomainName $domainName): bool
    {
        return $user->is_admin || $domainName->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user, DomainName $domainName): bool
    {
        return $user->is_admin || $domainName->user_id === $user->id;
    }
}
