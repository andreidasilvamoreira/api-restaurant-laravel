<?php

namespace App\Policies;

use App\Models\Pagamento;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PagamentoPolicy
{
    public function before(User $user, $ability)
    {
        return $user->role === 'SUPER_ADMIN' ? true : null;
    }
    public function viewAny(User $user): bool
    {

        return $user->role == 'OWNER' || true;
    }

    public function view(User $user, Pagamento $pagamento): bool
    {
        if ($user->role === 'OWNER') return true;

        $restaurante = $pagamento->pedido?->restaurante;
        return $this->hasRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    public function createForRestaurant(User $user, Restaurante $restaurante): bool
    {
        if ($user->role === 'OWNER') return false;

        return $this->hasRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    public function update(User $user, Pagamento $pagamento): bool
    {
        if ($user->role === 'OWNER') return false;

        $restaurante = $pagamento->pedido?->restaurante;
        return $this->hasRole($user, $restaurante, ['ADMIN', 'DONO']);
    }

    public function delete(User $user, Pagamento $pagamento): bool
    {
        if ($user->role === 'OWNER') return false;

        $restaurante = $pagamento->pedido?->restaurante;
        return $this->hasRole($user, $restaurante, ['DONO']);
    }

    private function hasRole(User $user, ?Restaurante $restaurante, array $role): bool
    {
        if (!$restaurante) return false;
        return $restaurante->users()->where('users.id', $user->id)->wherePivotIn('role', $role)->exists();
    }
}
