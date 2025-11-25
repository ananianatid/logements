<?php

namespace App\Policies;

use App\Models\AntecedentLogement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AntecedentLogementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AntecedentLogement $antecedentLogement): bool
    {
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
    public function update(User $user, AntecedentLogement $antecedentLogement): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AntecedentLogement $antecedentLogement): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AntecedentLogement $antecedentLogement): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AntecedentLogement $antecedentLogement): bool
    {
        return false;
    }
}
