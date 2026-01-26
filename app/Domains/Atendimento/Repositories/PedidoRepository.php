<?php

namespace App\Domains\Atendimento\Repositories;

use App\Models\Pedido;
use Illuminate\Support\Collection;

class PedidoRepository
{
    public function findAll(): Collection
    {
        return Pedido::all();
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
