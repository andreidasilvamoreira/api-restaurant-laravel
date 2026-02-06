<?php

namespace App\Policies;

use App\Models\Fornecedor;
use App\Models\Restaurante;
use App\Models\User;

class FornecedorPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->role === 'OWNER' || true;
    }

    public function view(User $user, Fornecedor $fornecedor): bool
    {
        if ($user->role === 'OWNER') return true;
        return $this->checkRole($user, $fornecedor->restaurante, ['DONO', 'FUNCIONARIO', 'ADMIN']);
    }

    public function createForRestaurante(User $user, Restaurante $restaurante): bool
    {
        return $this->checkRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    public function update(User $user, Fornecedor $fornecedor): bool
    {
        return $this->checkRole($user, $fornecedor->restaurante, ['DONO', 'ADMIN']);
    }

    public function delete(User $user, Fornecedor $fornecedor): bool
    {
        return $this->checkRole($user, $fornecedor->restaurante, ['DONO', 'ADMIN']);
    }

    private function checkRole(User $user, ?Restaurante $restaurante, array $role): bool
    {
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $role)->exists();
    }
}
