<?php

namespace App\Policies;

use App\Models\ItemMenu;
use App\Models\Restaurante;
use App\Models\User;

class ItemMenuPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }
    public function viewAny(User $user): bool
    {
        return $user->role === 'OWNER' || true;
    }

    public function view(User $user, ItemMenu $itemMenu): bool
    {
        if ($user->role === 'OWNER') return true;

        $restaurante = $itemMenu->categoria?->restaurante;

        return $this->checkRole($user, $restaurante, ['ADMIN', 'FUNCIONARIO', 'DONO']);
    }

    public function createForRestaurante(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->checkRole($user, $restaurante, ['ADMIN', 'FUNCIONARIO', 'DONO']);
    }

    public function update(User $user, ItemMenu $itemMenu): bool
    {
        if ($user->role === 'OWNER') return false;

        $restaurante = $itemMenu->categoria?->restaurante;
        return $this->checkRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    public function delete(User $user, ItemMenu $itemMenu): bool
    {
        if ($user->role === 'OWNER') return false;

        $restaurante = $itemMenu->categoria?->restaurante;

        return $this->checkRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    private function checkRole(User $user, ?Restaurante $restaurante, array $role): bool
    {
        if (!$restaurante) return false;
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $role)->exists();
    }
}
