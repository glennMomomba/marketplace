<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Vérifie directement dans la table pivot si l’utilisateur a un des rôles demandés
        if ($request->user()->roles()->whereIn('name', $roles)->exists()) {
            return $next($request);
        }

        abort(403, 'Accès interdit');
    }

}
