<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Auth\Access\HandlesAuthorization;

class OutletPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the outlet can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list outlets');
    }

    /**
     * Determine whether the outlet can view the model.
     */
    public function view(User $user, Outlet $model): bool
    {
        return $user->hasPermissionTo('view outlets');
    }

    /**
     * Determine whether the outlet can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create outlets');
    }

    /**
     * Determine whether the outlet can update the model.
     */
    public function update(User $user, Outlet $model): bool
    {
        return $user->hasPermissionTo('update outlets');
    }

    /**
     * Determine whether the outlet can delete the model.
     */
    public function delete(User $user, Outlet $model): bool
    {
        return $user->hasPermissionTo('delete outlets');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete outlets');
    }

    /**
     * Determine whether the outlet can restore the model.
     */
    public function restore(User $user, Outlet $model): bool
    {
        return false;
    }

    /**
     * Determine whether the outlet can permanently delete the model.
     */
    public function forceDelete(User $user, Outlet $model): bool
    {
        return false;
    }
}
