<?php

namespace App\Policies;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmpresaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver empresas');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Empresa $empresa): bool
    {
        return $user->hasPermissionTo('ver empresas');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear empresas');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Empresa $empresa): bool
    {
        return $user->hasPermissionTo('editar empresas');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Empresa $empresa): bool
    {
        return $user->hasPermissionTo('eliminar empresas');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Empresa $empresa): bool
    {
        return $user->hasPermissionTo('restaurar empresas');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Empresa $empresa): bool
    {
        return $user->hasPermissionTo('forzar eliminacion empresas');
    }
}
