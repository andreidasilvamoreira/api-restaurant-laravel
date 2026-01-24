<?php

namespace App\Domains\Atendimento\Repositories;

use App\Models\Cliente;
use Illuminate\Support\Collection;

class ClienteRepository
{
    public function findAll(): Collection
    {
        return Cliente::all();
    }

    public function find($id): Cliente
    {
        return Cliente::find($id);
    }

    public function create(array $data): Cliente
    {
        return Cliente::create($data);
    }

    public function update(Cliente $cliente, array $data): Cliente
    {
        $cliente->update($data);
        return $cliente;
    }

    public function delete(Cliente $cliente): void
    {
        $cliente->delete();
    }
}
