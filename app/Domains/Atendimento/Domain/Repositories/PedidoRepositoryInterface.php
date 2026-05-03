<?php

namespace App\Domains\Atendimento\Domain\Repositories;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Collection;

interface PedidoRepositoryInterface
{
    public function findAll(User $user, ?int $restauranteId = null): Collection;
    public function findOwnCustomerOrders(User $user): Collection;
    public function find(int $id): ?Pedido;
    public function create(array $data): Pedido;
    public function update(array $data, Pedido $pedido): Pedido;
    public function delete(Pedido $pedido): void;
}
