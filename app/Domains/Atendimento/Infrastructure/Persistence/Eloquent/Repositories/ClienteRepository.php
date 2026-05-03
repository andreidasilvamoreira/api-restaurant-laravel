<?php

namespace App\Domains\Atendimento\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Atendimento\Domain\Repositories\ClienteRepositoryInterface;
use App\Models\Cliente;
use Illuminate\Support\Collection;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function findAll(): Collection
    {
        return Cliente::all();
    }

    public function find(int $id): ?Cliente
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
