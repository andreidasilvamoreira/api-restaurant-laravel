<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $restauranteId = $request->route('restaurante');

        if (!$user || !$restauranteId || !$user->isActiveInRestaurant($restauranteId)) {
            return response()->json([
                'message' => 'Usuário inativo ou bloqueado neste restaurante.'
            ], 403);
        }

        return $next($request);
    }
}
