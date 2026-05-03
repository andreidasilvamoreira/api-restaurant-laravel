<?php

namespace App\Domains\Atendimento\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Atendimento\Domain\Repositories\PedidoRepositoryInterface;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Collection;

class PedidoRepository implements PedidoRepositoryInterface
{
    public function findAll(User $user, ?int $restauranteId = null): Collection
    {
        $query = Pedido::query()->with('itensPedido.itemMenu');

        if ($restauranteId !== null) {
            $query->where('restaurante_id', $restauranteId);
        }

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('restaurante', function ($q) use ($user) {
                $q->whereHas('users', function ($q2) use ($user) {
                    $q2->whereKey($user->id)->whereIn('restaurante_users.role', ['ADMIN', 'DONO']);
                });
            });
        }

        return $query->get();
    }

    public function findOwnCustomerOrders(User $user): Collection
    {
        $clienteId = $user->cliente?->id;

        if (!$clienteId) {
            return collect();
        }

        return Pedido::query()
            ->with('itensPedido.itemMenu')
            ->where('cliente_id', $clienteId)
            ->latest('data_hora')
            ->get();
    }

    public function find(int $id): ?Pedido
    {
        return Pedido::query()
            ->with('itensPedido.itemMenu')
            ->find($id);
    }

    public function create(array $data): Pedido
    {
        return Pedido::query()->create($data)->load('itensPedido.itemMenu');
    }

    public function update(array $data, Pedido $pedido): Pedido
    {
        $pedido->update($data);
        return $pedido->fresh(['itensPedido.itemMenu']);
    }

    public function delete(Pedido $pedido): void
    {
        $pedido->delete();
    }
}
