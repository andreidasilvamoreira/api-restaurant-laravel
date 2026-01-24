<?php

namespace App\Domains\Atendimento\Services;

use App\Domains\Atendimento\Repositories\ClienteRepository;
use App\Models\Cliente;
use Illuminate\Support\Collection;

class ClienteService
{
    protected ClienteRepository $clienteRepository;
    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }
    public function findAll(): Collection
    {
        return $this->clienteRepository->findAll();
    }

    public function find($id): ?Cliente
    {
        return $this->clienteRepository->find($id);
    }

    public function create(array $data): Cliente
    {
        return $this->clienteRepository->create($data);
    }

    public function update(array $data, int $id): Cliente
    {
        $cliente = $this->findOrFail($id);
        return $this->clienteRepository->update($cliente, $data);
    }

    public function delete(int $id): void
    {
        $cliente = $this->findOrFail($id);
        $this->clienteRepository->delete($cliente);
    }

    public function findOrFail(int $id): Cliente
    {
        return $this->clienteRepository->find($id) ?? abort(404, 'Catalogo não encontrado');
    }
}
