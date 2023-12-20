<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the feedback can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list feedbacks');
    }

    /**
     * Determine whether the feedback can view the model.
     */
    public function view(User $user, Feedback $model): bool
    {
        return $user->hasPermissionTo('view feedbacks');
    }

    /**
     * Determine whether the feedback can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create feedbacks');
    }

    /**
     * Determine whether the feedback can update the model.
     */
    public function update(User $user, Feedback $model): bool
    {
        return $user->hasPermissionTo('update feedbacks');
    }

    /**
     * Determine whether the feedback can delete the model.
     */
    public function delete(User $user, Feedback $model): bool
    {
        return $user->hasPermissionTo('delete feedbacks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete feedbacks');
    }

    /**
     * Determine whether the feedback can restore the model.
     */
    public function restore(User $user, Feedback $model): bool
    {
        return false;
    }

    /**
     * Determine whether the feedback can permanently delete the model.
     */
    public function forceDelete(User $user, Feedback $model): bool
    {
        return false;
    }
}
