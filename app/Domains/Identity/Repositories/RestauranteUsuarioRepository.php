<?php

namespace App\Domains\Identity\Repositories;

use App\Models\Restaurante;
use App\Models\User;

class RestauranteUsuarioRepository
{
    /* essa função cria um relacionamento entre duas tabelas existentes (só pra lembrar) */

    public function attach(Restaurante $restaurante, User $user, string $role): void
    {
        $restaurante->users()->syncWithoutDetaching([$user->id => ['role' => $role]]);
    }
    /* essa função apaga APENAS o relacionamento */
    public function detach(Restaurante $restaurante, int $id): void
    {
        $restaurante->users()->detach($id);
    }

    public function updateRole(Restaurante $restaurante, int $userId, string $role): void
    {
        $restaurante->users()->updateExistingPivot($userId, ['role' => $role]);
    }

    public function exists(Restaurante $restaurante, int $id): bool
    {
        return $restaurante->users()->wherePivot('user_id', $id)->exists();
    }

    public function listPorRestaurante(Restaurante $restaurante)
    {
        return $restaurante->users()->withPivot('role')->get();
    }
}
