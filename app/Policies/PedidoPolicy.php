<?php

namespace App\Policies;

use App\Models\Pedido;
use App\Models\Restaurante;
use App\Models\User;

class PedidoPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }
    public function viewAny(User $user): bool
    {
        return $user->role === 'OWNER' || true;
    }

    public function view(User $user, Pedido $pedido): bool
    {
        if ($pedido->user_id === $user->id) return true;

        return $this->hasRole($user, $pedido->restaurante, ['ADMIN', 'DONO']) || $user->role === 'OWNER';
    }

    public function createForRestaurant(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->hasRole($user, $restaurante, ['CLIENTE','ADMIN', 'DONO']);
    }

    public function update(User $user, Pedido $pedido): bool
    {
        if ($user->role === 'OWNER') return false;
        if ($pedido->user_id === $user->id) {
            return in_array($pedido->status, ['aberto']);
        }

        return $this->hasRole($user, $pedido->restaurante, ['ADMIN', 'DONO']);
    }

    public function delete(User $user, Pedido $pedido): bool
    {
        if ($user->role === 'OWNER') return false;
        if ($pedido->user_id === $user->id) {
            return in_array($pedido->status, ['aberto']);
        }
        return $this->hasRole($user, $pedido->restaurante, ['ADMIN', 'DONO']);
    }

    private function hasRole(User $user, ?Restaurante $restaurante, array $roles): bool
    {
        if (!$restaurante) return false;
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $roles)->exists();
    }
}
