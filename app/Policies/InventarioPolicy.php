<?php

namespace App\Policies;

use App\Models\Inventario;
use App\Models\Restaurante;
use App\Models\User;

class InventarioPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Inventario $inventario): bool
    {
        return $this->checkRole($user, $inventario, ['ADMIN', 'FUNCIONARIO', 'DONO']);
    }

    public function create(User $user, Restaurante $restaurante): bool
    {
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', ['ADMIN', 'FUNCIONARIO', 'DONO'])->exists() || $user->role === 'OWNER';
    }

    public function update(User $user, Inventario $inventario): bool
    {
        return $this->checkRole($user, $inventario, ['ADMIN', 'FUNCIONARIO', 'DONO']);
    }

    public function delete(User $user, Inventario $inventario): bool
    {
        return $this->checkRole($user, $inventario, ['ADMIN', 'FUNCIONARIO', 'DONO']);
    }

    private function checkRole(User $user, Inventario $inventario, array $roles): bool
    {
        return $inventario->restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $roles)->exists() || $user->role === 'OWNER';
    }
}
