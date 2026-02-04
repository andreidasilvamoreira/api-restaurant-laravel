<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = auth()->user();
        if ($user->role === 'SUPER_ADMIN') {
            return $next($request);
        }

        $restauranteId = $request->route('restaurante');

        /* usuario precisa ter a role necessária pra passar */

        if (!$user || !$user->hasRole($role, $restauranteId)) {
            return response([
                'message' => 'Acesso negado'
            ], 403);
        }
        return $next($request);
    }
}
