<?php

namespace App\Domains\Catalogo\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Catalogo\Domain\Repositories\CategoriaRepositoryInterface;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Collection;

class CategoriaRepository implements CategoriaRepositoryInterface
{
    public function findAll(User $user, ?int $restauranteId = null): Collection
    {
        $query = Categoria::query();

        if ($restauranteId !== null) {
            $query->where('restaurante_id', $restauranteId);
        }

        return $query->get();
    }

    public function find(int $id) : ?Categoria
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
