<?php

namespace App\Policies;

use App\Models\Reserva;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReservaPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Reserva $reserva): bool
    {
        if ($user->role === 'OWNER') return true;
        return $this->hasRole($user, $reserva->restaurante,['ADMIN', 'DONO']);
    }

    public function createForRestaurant(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return false;
        return $this->hasRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    public function update(User $user, Reserva $reserva): bool
    {
        if ($user->role === 'OWNER') return false;
        return $this->hasRole($user, $reserva->restaurante, ['ADMIN', 'DONO']);
    }

    public function delete(User $user, Reserva $reserva): bool
    {
        if ($user->role === 'OWNER') return false;
        return $this->hasRole($user, $reserva->restaurante, ['ADMIN', 'DONO']);
    }

    private function hasRole(User $user, ?Restaurante $restaurante, array $roles): bool
    {
        if (!$restaurante) return false;
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $roles)->exists();
    }
}
