<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Store;
use Illuminate\Auth\Access\Response;

class StorePolicy
{
    // public function before(User $user)
    // {
    //     if($user->hasRole(['super-admin'])) return true;

    //     return null;
    // }

    public function viewAny(User $user): bool
    {
        if($user->hasRole(['super-admin', 'admin'])) return true;
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Store $stores): bool
    {
        if($user->hasRole(['super-admin', 'admin'])) return true;
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Store $store): bool
    {
        if($user->hasRole(['super-admin', 'admin'])) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Store $store): bool
    {
        if($user->hasRole(['super-admin'])) return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Store $store): bool
    {
        if($user->hasRole(['super-admin'])) return true;
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Store $store): bool
    {
        if($user->hasRole(['super-admin'])) return true;
        return false;
    }
}
