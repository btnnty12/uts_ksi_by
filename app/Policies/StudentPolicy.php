<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Both admin and operator can view students
        return $user->isAdmin() || $user->isOperator();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Student $student): bool
    {
        // Both admin and operator can view students
        return $user->isAdmin() || $user->isOperator();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Both admin and operator can create students
        return $user->isAdmin() || $user->isOperator();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Student $student): bool
    {
        // Both admin and operator can update students
        return $user->isAdmin() || $user->isOperator();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Student $student): bool
    {
        // Only admin can delete students
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Student $student): bool
    {
        // Only admin can restore students
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Student $student): bool
    {
        // Only admin can force delete students
        return $user->isAdmin();
    }
}
