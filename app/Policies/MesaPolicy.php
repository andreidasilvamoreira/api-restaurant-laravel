<?php

namespace App\Policies;

use App\Models\Mesa;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MesaPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }
    public function viewAny(User $user): bool
    {
        return $user->role === 'OWNER' || true;
    }

    public function view(User $user, Mesa $mesa): bool
    {
        return $this->hasRole($user, $mesa->restaurante, ['ADMIN', 'DONO']) || $user->role === 'OWNER';
    }

    public function createForRestaurant(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return false;
        return $this->hasRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    public function update(User $user, Mesa $mesa): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->hasRole($user, $mesa->restaurante, ['ADMIN', 'DONO']);
    }

    public function delete(User $user, Mesa $mesa): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->hasRole($user, $mesa->restaurante, ['ADMIN', 'DONO']);
    }

    private function hasRole(User $user, ?Restaurante $restaurante, array $roles): bool
    {
        if (!$restaurante) return false;
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $roles)->exists();
    }
}
