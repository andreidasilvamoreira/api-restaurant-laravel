<?php

namespace App\Policies;

use App\Models\Fornecedor;
use App\Models\Restaurante;
use App\Models\User;

class FornecedorPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === User::ROLE_SUPER_ADMIN ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->role === User::ROLE_OWNER || true;
    }

    public function view(User $user, Fornecedor $fornecedor): bool
    {
        if ($user->role === User::ROLE_OWNER) return true;
        return $this->checkRole($user, $fornecedor->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function createForRestaurante(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->checkRole($user, $restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function update(User $user, Fornecedor $fornecedor): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->checkRole($user, $fornecedor->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function delete(User $user, Fornecedor $fornecedor): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->checkRole($user, $fornecedor->restaurante, [Restaurante::ROLE_DONO]);
    }

    private function checkRole(User $user, ?Restaurante $restaurante, array $role): bool
    {
        if (!$restaurante) return false;

        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $role)->exists();
    }
}
