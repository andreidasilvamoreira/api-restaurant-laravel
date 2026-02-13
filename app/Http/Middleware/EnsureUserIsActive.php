<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $restaurante = $request->route('restaurante');

        if ($user->role === User::ROLE_SUPER_ADMIN) {
            return $next($request);
        }

        if (!$user || !$restaurante || !$user->isActiveInRestaurant($restaurante->id)) {
            return response()->json([
                'message' => 'Usuário inativo ou bloqueado neste restaurante.'
            ], 403);
        }

        return $next($request);
    }
}
