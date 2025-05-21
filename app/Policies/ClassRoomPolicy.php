<?php

namespace App\Policies;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassRoomPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Both admin and operator can view classes
        return $user->isAdmin() || $user->isOperator();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ClassRoom $classRoom): bool
    {
        // Both admin and operator can view classes
        return $user->isAdmin() || $user->isOperator();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only admin can create classes
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ClassRoom $classRoom): bool
    {
        // Only admin can update classes
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ClassRoom $classRoom): bool
    {
        // Only admin can delete classes
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ClassRoom $classRoom): bool
    {
        // Only admin can restore classes
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ClassRoom $classRoom): bool
    {
        // Only admin can force delete classes
        return $user->isAdmin();
    }
}
