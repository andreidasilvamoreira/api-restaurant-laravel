<?php

namespace App\Http\Services;

use App\Http\Repositories\CategoriaRepository;

class CategoriaService
{
    protected CategoriaRepository $categoriaRepository;
    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function findAll()
    {
        return $this->categoriaRepository->findAll();
    }

    public function find(int $id)
    {
        $categoria = $this->findOrFail($id);
        return $categoria;
    }

    public function create(array $data)
    {
        return $this->categoriaRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        $categoria = $this->findOrFail($id);
        $categoria = $this->categoriaRepository->update( $categoria, $data);

        return $categoria;
    }

    public function delete(int $id)
    {
        $categoria = $this->findOrFail($id);
        $this->categoriaRepository->delete($categoria);
    }

    public function findOrFail($id)
    {
        return $this->categoriaRepository->find($id) ?? abort(404, 'Categoria não encontrada');
    }
}
