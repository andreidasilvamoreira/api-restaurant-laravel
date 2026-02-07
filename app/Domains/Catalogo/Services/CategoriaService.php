<?php

namespace App\Domains\Catalogo\Services;

use App\Domains\Catalogo\Exceptions\Categoria\CategoriaNotFoundException;
use App\Domains\Catalogo\Repositories\CategoriaRepository;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Collection;

class CategoriaService
{
    protected CategoriaRepository $categoriaRepository;
    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function findAll(User $user): Collection
    {
        return $this->categoriaRepository->findAll($user);
    }

    public function find(int $id): ?Categoria
    {
        return $this->findOrFail($id);
    }

    public function create(array $data): Categoria
    {
        return $this->categoriaRepository->create($data);
    }

    public function update(array $data, int $id): Categoria
    {
        $categoria = $this->findOrFail($id);
        return $this->categoriaRepository->update($categoria, $data);
    }

    public function delete(int $id): void
    {
        $categoria = $this->findOrFail($id);
        $this->categoriaRepository->delete($categoria);
    }

    public function findOrFail(int $id): Categoria
    {
        $categoria = $this->categoriaRepository->find($id);
        if (!$categoria) {
            throw new CategoriaNotFoundException();
        }
        return $categoria;
    }

}
