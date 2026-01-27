<?php

namespace App\Domains\Inventario\Repositories;

use App\Models\Inventario;
use Illuminate\Support\Collection;

class InventarioRepository
{
    public function findAll(): Collection
    {
        return Inventario::all();
    }

    public function find(int $id): ?Inventario
    {
        return Inventario::find($id);
    }

    public function create(array $data): Inventario
    {
        return Inventario::create($data);
    }

    public function update(array $data, Inventario $inventario): Inventario
    {
        $inventario->update($data);
        return $inventario;
    }

    public function delete(Inventario $inventario): void
    {
        $inventario->delete();
    }
}
