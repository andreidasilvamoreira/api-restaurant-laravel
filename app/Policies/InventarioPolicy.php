<?php

namespace App\Policies;

use App\Models\Inventario;
use App\Models\Restaurante;
use App\Models\User;

class InventarioPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === User::ROLE_SUPER_ADMIN ? true : null;
    }

    public function viewAny(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return true;
        return $this->checkRole($user, $restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function view(User $user, Inventario $inventario): bool
    {
        if ($user->role === User::ROLE_OWNER) return true;
        return $this->checkRole($user, $inventario->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function createForRestaurante(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->checkRole($user, $restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function update(User $user, Inventario $inventario): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->checkRole($user, $inventario->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function delete(User $user, Inventario $inventario): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->checkRole($user, $inventario->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    private function checkRole(User $user, ?Restaurante $restaurante, array $roles): bool
    {
        if (!$restaurante) return false;

        return $restaurante->users()->whereKey($user->id)->wherePivotIn('role', $roles)->exists();
    }
}
