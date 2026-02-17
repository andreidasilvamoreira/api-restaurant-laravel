<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientePolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === User::ROLE_SUPER_ADMIN ? true : null;
    }
    public function viewAny(User $user): bool
    {
        return $user->role === User::ROLE_OWNER;
    }

    public function view(User $user, Cliente $cliente): bool
    {
        if ($user->role === User::ROLE_OWNER) return true;
        return $this->ownsCliente($user, $cliente);
    }

    public function create(User $user): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return !$user->cliente()->exists();
    }

    public function update(User $user, Cliente $cliente): bool
    {
        if ($user->role === User::ROLE_OWNER) return false;

        return $this->ownsCliente($user, $cliente);
    }

    public function delete(User $user, Cliente $cliente)
    {
        return false;
    }

    private function ownsCliente(User $user, Cliente $cliente): bool
    {
        return $user->id === $cliente->user_id;
    }
}
