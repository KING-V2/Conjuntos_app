<?php

namespace App\Policies;

use App\Models\TarifasConjunto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TarifasConjuntoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TarifasConjunto $tarifasConjunto): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TarifasConjunto $tarifasConjunto): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TarifasConjunto $tarifasConjunto): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TarifasConjunto $tarifasConjunto): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TarifasConjunto $tarifasConjunto): bool
    {
        //
    }
}
