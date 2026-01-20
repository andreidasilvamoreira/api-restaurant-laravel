<?php

namespace App\Http\Services;

use App\Exceptions\Categoria\CategoriaNotFoundException;
use App\Http\Repositories\CategoriaRepository;
use App\Models\Categoria;
use Illuminate\Support\Collection;

class CategoriaService
{
    protected CategoriaRepository $categoriaRepository;
    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function findAll(): Collection
    {
        return $this->categoriaRepository->findAll();
    }

    public function find(int $id): ?Categoria
    {
        $categoria = $this->findOrFail($id);
        return $categoria;
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
