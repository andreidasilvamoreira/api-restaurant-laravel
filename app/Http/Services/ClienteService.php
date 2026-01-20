<?php

namespace App\Http\Services;

use App\Http\Repositories\ClienteRepository;
use App\Models\Cliente;

class ClienteService
{
    protected ClienteRepository $clienteRepository;
    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }
    public function findAll()
    {
        return $this->clienteRepository->findAll();
    }

    public function find($id)
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

    public function delete(int $id){
        $cliente = $this->findOrFail($id);
        $this->clienteRepository->delete($cliente);
    }

    public function findOrFail(int $id)
    {
        return $this->clienteRepository->find($id) ?? abort(404, 'Cliente não encontrado');
    }
}
