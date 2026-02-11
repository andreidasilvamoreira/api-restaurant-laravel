<?php

namespace App\Domains\Atendimento\Repositories;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Collection;

class PedidoRepository
{
    public function findAll(User $user): Collection
    {
        $query = Pedido::query();

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER')
        {
            $query->whereHas('restaurante', function ($q) use ($user) {
                $q->whereHas('users', function ($q2) use ($user) {
                    $q2->whereKey($user->id)->whereIn('restaurante_users.role', ['ADMIN', 'DONO']);
                });
            });
        }
        return $query->get();
    }

    public function find(int $id): ?Pedido
    {
        return Pedido::find($id);
    }

    public function create(array $data): Pedido
    {
        return Pedido::create($data);
    }

    public function update(array $data, Pedido $pedido): Pedido
    {
        $pedido->update($data);
        return $pedido;
    }

    public function delete(Pedido $pedido): void
    {
        $pedido->delete();
    }
}
