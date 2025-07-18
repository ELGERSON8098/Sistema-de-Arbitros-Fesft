<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Si no se especifican roles, solo verificar que esté autenticado
        if (empty($roles)) {
            return $next($request);
        }

        // Verificar si el usuario tiene alguno de los roles especificados
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // Si no tiene ningún rol válido, denegar acceso
        abort(403, 'No tienes permisos para acceder a esta sección.');
    }
}
