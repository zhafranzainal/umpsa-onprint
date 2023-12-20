<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rider;
use Illuminate\Auth\Access\HandlesAuthorization;

class RiderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rider can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list riders');
    }

    /**
     * Determine whether the rider can view the model.
     */
    public function view(User $user, Rider $model): bool
    {
        return $user->hasPermissionTo('view riders');
    }

    /**
     * Determine whether the rider can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create riders');
    }

    /**
     * Determine whether the rider can update the model.
     */
    public function update(User $user, Rider $model): bool
    {
        return $user->hasPermissionTo('update riders');
    }

    /**
     * Determine whether the rider can delete the model.
     */
    public function delete(User $user, Rider $model): bool
    {
        return $user->hasPermissionTo('delete riders');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete riders');
    }

    /**
     * Determine whether the rider can restore the model.
     */
    public function restore(User $user, Rider $model): bool
    {
        return false;
    }

    /**
     * Determine whether the rider can permanently delete the model.
     */
    public function forceDelete(User $user, Rider $model): bool
    {
        return false;
    }
}
