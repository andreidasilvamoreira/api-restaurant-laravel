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
        return $user->role === User::ROLE_SUPER_ADMIN ? true : null;
    }
    public function viewAny(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return true;
        return $this->hasRole($user, $restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]) || $user->role === User::ROLE_OWNER;
    }

    public function view(User $user, Mesa $mesa): bool
    {
        return $this->hasRole($user, $mesa->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]) || $user->role === User::ROLE_OWNER;
    }

    public function createForRestaurant(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;
        return $this->hasRole($user, $restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function update(User $user, Mesa $mesa): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->hasRole($user, $mesa->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function delete(User $user, Mesa $mesa): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->hasRole($user, $mesa->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    private function hasRole(User $user, ?Restaurante $restaurante, array $roles): bool
    {
        if (!$restaurante) return false;
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $roles)->exists();
    }
}
