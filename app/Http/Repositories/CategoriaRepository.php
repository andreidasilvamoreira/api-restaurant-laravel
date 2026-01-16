<?php

namespace App\Http\Repositories;

use App\Models\Categoria;
use Illuminate\Support\Collection;

class CategoriaRepository
{
    public function findAll(): Collection
    {
        return Categoria::all();
    }

    public function find(int $id): Categoria
    {
        return Categoria::find($id);
    }

    public function create(array $data): Categoria
    {
        return Categoria::create($data);
    }

    public function update(Categoria $categoria, array $data) : Categoria
    {
        $categoria->update($data);
        return $categoria;
    }

    public function delete(Categoria $categoria): void
    {
        $categoria->delete();
    }
}
