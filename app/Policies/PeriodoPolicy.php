<?php

namespace App\Policies;

use App\Models\Periodo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PeriodoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver periodos');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Periodo $periodo): bool
    {
        return $user->hasPermissionTo('ver periodos');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear periodos');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Periodo $periodo): bool
    {
        return $user->hasPermissionTo('editar periodos');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Periodo $periodo): bool
    {
        return $user->hasPermissionTo('eliminar periodos');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Periodo $periodo): bool
    {
        return $user->hasPermissionTo('restaurar periodos');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Periodo $periodo): bool
    {
        return $user->hasPermissionTo('forzar eliminacion periodos');
    }
}
