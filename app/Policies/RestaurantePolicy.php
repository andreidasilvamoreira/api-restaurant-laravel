<?php

namespace App\Policies;

use App\Models\Restaurante;
use App\Models\User;

class RestaurantePolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }
    public function viewAny(User $user): bool
    {
        return $user->role === 'OWNER' || true;
    }

    public function view(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return true;
        return $this->checkMethod($user, $restaurante, ['DONO', 'ADMIN', 'FUNCIONARIO']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'OWNER';
    }

    public function update(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->checkMethod($user, $restaurante, ['DONO', 'ADMIN']);
    }

    public function delete(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->checkMethod($user, $restaurante, ['DONO']);
    }

    private function checkMethod(User $user, ?Restaurante $restaurante, array $rolesPivot): bool
    {
        if (!$restaurante) return false;

        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $rolesPivot)->exists();
    }
}
