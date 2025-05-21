<?php

namespace App\Policies;

use App\Models\NoteAct;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NoteActPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Only admin can view activity logs
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NoteAct $noteAct): bool
    {
        // Only admin can view activity logs
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // No one should manually create activity logs through UI
        // Logs are created automatically by the system
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NoteAct $noteAct): bool
    {
        // Activity logs should not be editable
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NoteAct $noteAct): bool
    {
        // Only admin can delete activity logs
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NoteAct $noteAct): bool
    {
        // Only admin can restore activity logs
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NoteAct $noteAct): bool
    {
        // Only admin can force delete activity logs
        return $user->isAdmin();
    }
}
