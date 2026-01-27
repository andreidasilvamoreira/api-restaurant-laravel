<?php

namespace App\Domains\Atendimento\Services;

use App\Domains\Atendimento\Exceptions\Pedido\PedidoNotFoundException;
use App\Domains\Atendimento\Repositories\PedidoRepository;
use App\Models\Pedido;
use Illuminate\Support\Collection;

class PedidoService
{
    protected PedidoRepository $pedidoRepository;
    public function __construct(PedidoRepository $pedidoRepository)
    {
        $this->pedidoRepository = $pedidoRepository;
    }

    public function findAll(): Collection
    {
        return $this->pedidoRepository->findAll();
    }

    public function find(int $id): Pedido
    {
        return $this->findOrFail($id);
    }

    public function create(array $data): Pedido
    {
        return $this->pedidoRepository->create($data);
    }

    public function update(array $data, int $id): Pedido
    {
        $pedido  = $this->findOrFail($id);
        return $this->pedidoRepository->update($data, $pedido);
    }

    public function delete(int $id): void
    {
        $pedido = $this->findOrFail($id);
        $this->pedidoRepository->delete($pedido);
    }

    public function findOrFail(int $id): Pedido
    {
        $pedido = $this->pedidoRepository->find($id);
        if(!$pedido){
            throw new PedidoNotFoundException();
        }

        return $pedido;
    }
}
