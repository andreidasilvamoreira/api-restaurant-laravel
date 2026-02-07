<?php

namespace App\Domains\Catalogo\Repositories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Collection;

class CategoriaRepository
{
    public function findAll(User $user): Collection
    {
        $query = Categoria::query();

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('restaurante', function ($q) use ($user) {
                $q->whereHas('users', function ($q2) use ($user) {
                    $q2->whereKey($user->id)->whereIn('restaurante_users.role', ['DONO', 'ADMIN', 'FUNCIONARIO']);
                });
            });
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
