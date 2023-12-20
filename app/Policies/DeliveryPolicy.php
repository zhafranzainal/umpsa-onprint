<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Delivery;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the delivery can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list deliveries');
    }

    /**
     * Determine whether the delivery can view the model.
     */
    public function view(User $user, Delivery $model): bool
    {
        return $user->hasPermissionTo('view deliveries');
    }

    /**
     * Determine whether the delivery can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create deliveries');
    }

    /**
     * Determine whether the delivery can update the model.
     */
    public function update(User $user, Delivery $model): bool
    {
        return $user->hasPermissionTo('update deliveries');
    }

    /**
     * Determine whether the delivery can delete the model.
     */
    public function delete(User $user, Delivery $model): bool
    {
        return $user->hasPermissionTo('delete deliveries');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete deliveries');
    }

    /**
     * Determine whether the delivery can restore the model.
     */
    public function restore(User $user, Delivery $model): bool
    {
        return false;
    }

    /**
     * Determine whether the delivery can permanently delete the model.
     */
    public function forceDelete(User $user, Delivery $model): bool
    {
        return false;
    }
}
