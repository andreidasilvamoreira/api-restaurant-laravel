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
        return $user->role === 'OWNER' || true;
    }

    public function view(User $user, Inventario $inventario): bool
    {
        if ($user->role === 'OWNER') return true;
        return $this->checkRole($user, $inventario->restaurante, ['ADMIN', 'DONO']);
    }

    public function createForRestaurante(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->checkRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    public function update(User $user, Inventario $inventario): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->checkRole($user, $inventario->restaurante, ['ADMIN', 'DONO']);
    }

    public function delete(User $user, Inventario $inventario): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->checkRole($user, $inventario->restaurante, ['ADMIN', 'DONO']);
    }

    private function checkRole(User $user, ?Restaurante $restaurante, array $roles): bool
    {
        if (!$restaurante) return false;

        return $restaurante->users()->whereKey($user->id)->wherePivotIn('role', $roles)->exists();
    }
}
