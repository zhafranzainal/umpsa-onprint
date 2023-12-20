<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DeliveryOption;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryOptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the deliveryOption can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list deliveryoptions');
    }

    /**
     * Determine whether the deliveryOption can view the model.
     */
    public function view(User $user, DeliveryOption $model): bool
    {
        return $user->hasPermissionTo('view deliveryoptions');
    }

    /**
     * Determine whether the deliveryOption can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create deliveryoptions');
    }

    /**
     * Determine whether the deliveryOption can update the model.
     */
    public function update(User $user, DeliveryOption $model): bool
    {
        return $user->hasPermissionTo('update deliveryoptions');
    }

    /**
     * Determine whether the deliveryOption can delete the model.
     */
    public function delete(User $user, DeliveryOption $model): bool
    {
        return $user->hasPermissionTo('delete deliveryoptions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete deliveryoptions');
    }

    /**
     * Determine whether the deliveryOption can restore the model.
     */
    public function restore(User $user, DeliveryOption $model): bool
    {
        return false;
    }

    /**
     * Determine whether the deliveryOption can permanently delete the model.
     */
    public function forceDelete(User $user, DeliveryOption $model): bool
    {
        return false;
    }
}
