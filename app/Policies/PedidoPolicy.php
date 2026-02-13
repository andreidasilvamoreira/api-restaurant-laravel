<?php

namespace App\Policies;

use App\Models\Pedido;
use App\Models\Restaurante;
use App\Models\User;

class PedidoPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === User::ROLE_SUPER_ADMIN ? true : null;
    }
    public function viewAny(User $user): bool
    {
        return $user->role === User::ROLE_OWNER || true;
    }

    public function view(User $user, Pedido $pedido): bool
    {
        if ($pedido->user_id === $user->id) return true;

        return $this->hasRole($user, $pedido->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]) || $user->role === User::ROLE_OWNER;
    }

    public function createForRestaurant(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->hasRole($user, $restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function update(User $user, Pedido $pedido): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;
        if ($pedido->user_id === $user->id) {
            return in_array($pedido->status, ['aberto']);
        }

        return $this->hasRole($user, $pedido->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function delete(User $user, Pedido $pedido): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;
        if ($pedido->user_id === $user->id) {
            return in_array($pedido->status, ['aberto']);
        }
        return $this->hasRole($user, $pedido->restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    private function hasRole(User $user, ?Restaurante $restaurante, array $roles): bool
    {
        if (!$restaurante) return false;
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $roles)->exists();
    }
}
