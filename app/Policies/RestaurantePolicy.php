<?php

namespace App\Policies;

use App\Models\Restaurante;
use App\Models\User;

class RestaurantePolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === User::ROLE_SUPER_ADMIN ? true : null;
    }

    public function manageUsers(User $user, Restaurante $restaurante)
    {
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN])->exists();
    }

    public function viewAny(User $user): bool
    {
        return $user->role === User::ROLE_OWNER|| true;
    }

    public function view(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return true;
        return $this->checkMethod($user, $restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function create(User $user): bool
    {
        return $user->role === User::ROLE_OWNER;
    }

    public function update(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->checkMethod($user, $restaurante, [Restaurante::ROLE_DONO, Restaurante::ROLE_ADMIN]);
    }

    public function delete(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->checkMethod($user, $restaurante, [Restaurante::ROLE_DONO]);
    }

    private function checkMethod(User $user, ?Restaurante $restaurante, array $rolesPivot): bool
    {
        if (!$restaurante) return false;

        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $rolesPivot)->exists();
    }
}
