<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\Restaurante;
use App\Models\User;

class CategoriaPolicy
{

    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }
    public function viewAny(User $user): bool
    {
        return $user->role === 'OWNER' || true;
    }

    public function view(User $user, Categoria $categoria): bool
    {
        if ($user->role === 'OWNER') return true;
        return $this->checkRole($user, $categoria->restaurante, ['DONO', 'ADMIN', 'FUNCIONARIO', 'CLIENTE']);
    }

    public function createForRestaurante(User $user, Restaurante $restaurante): bool
    {

        return $this->checkRole($user, $restaurante, ['DONO', 'ADMIN']);
    }

    public function update(User $user, Categoria $categoria): bool
    {
        return $this->checkRole($user, $categoria->restaurante, ['DONO', 'ADMIN']);
    }

    public function delete(User $user, Categoria $categoria): bool
    {
        return $this->checkRole($user, $categoria->restaurante, ['DONO']);
    }

    private function checkRole(User $user, ?Restaurante $restaurante, array $role): bool
    {
        if (!$restaurante) return false;

        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $role)->exists();
    }
}
