<?php

namespace App\Domains\Catalogo\Domain\Repositories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Collection;

interface CategoriaRepositoryInterface
{
    public function findAll(User $user, ?int $restauranteId = null): Collection;
    public function find(int $id): ?Categoria;
    public function create(array $data): Categoria;
    public function update(Categoria $categoria, array $data): Categoria;
    public function delete(Categoria $categoria): void;
}
