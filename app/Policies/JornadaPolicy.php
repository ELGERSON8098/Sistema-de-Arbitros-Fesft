<?php

namespace App\Policies;

use App\Models\Jornada;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JornadaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(['ver_jornadas', 'crear_jornadas', 'editar_jornadas', 'eliminar_jornadas']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Jornada $jornada): bool
    {
        return $user->hasAnyPermission(['ver_jornadas', 'crear_jornadas', 'editar_jornadas', 'eliminar_jornadas']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear_jornadas');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Jornada $jornada): bool
    {
        return $user->hasPermissionTo('editar_jornadas');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Jornada $jornada): bool
    {
        return $user->hasPermissionTo('eliminar_jornadas');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Jornada $jornada): bool
    {
        return $user->hasPermissionTo('editar_jornadas');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Jornada $jornada): bool
    {
        return $user->hasPermissionTo('eliminar_jornadas');
    }
}
