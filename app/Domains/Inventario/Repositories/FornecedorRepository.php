<?php

namespace App\Domains\Inventario\Repositories;

use App\Models\Fornecedor;
use Illuminate\Support\Collection;

class FornecedorRepository
{
    public function findAll(): Collection
    {
        return Fornecedor::all();
    }

    public function find(int $id): ?Fornecedor
    {
        return Fornecedor::find($id);
    }

    public function create(array $data): Fornecedor
    {
        return Fornecedor::create($data);
    }

    public function update(array $data, Fornecedor $fornecedor): Fornecedor
    {
        $fornecedor->update($data);
        return $fornecedor;
    }

    public function delete(Fornecedor $fornecedor): void
    {
        $fornecedor->delete();
    }
}
