<?php

namespace App\Policies;

use App\Models\Carrera;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarreraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver carreras');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Carrera $carrera): bool
    {
        return $user->hasPermissionTo('ver carreras');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear carreras');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Carrera $carrera): bool
    {
        return $user->hasPermissionTo('editar carreras');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Carrera $carrera): bool
    {
        return $user->hasPermissionTo('eliminar carreras');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Carrera $carrera): bool
    {
        return $user->hasPermissionTo('restaurar carreras');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Carrera $carrera): bool
    {
        return $user->hasPermissionTo('forzar eliminacion carreras');
    }
}
