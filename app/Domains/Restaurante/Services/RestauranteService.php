<?php

namespace App\Domains\Restaurante\Services;

use App\Domains\Restaurante\Repositories\RestauranteRepository;
use App\Models\Restaurante;
use Illuminate\Support\Collection;
use RestauranteNotFoundException;

class RestauranteService
{
    protected RestauranteRepository $restauranteRepository;
    public function __construct(RestauranteRepository $restauranteRepository)
    {
        $this->restauranteRepository = $restauranteRepository;
    }

    public function findAll(): Collection
    {
        return $this->restauranteRepository->findAll();
    }

    public function find(int $id): ?Restaurante
    {
        return $this->findOrFail($id);
    }

    public function create(array $data): Restaurante
    {
        return $this->restauranteRepository->create($data);
    }

    public function update(int $id, array $data): Restaurante
    {
        $restaurante = $this->findOrFail($id);
        return $this->restauranteRepository->update($restaurante, $data);
    }

    public function delete(int $id): void
    {
        $restaurante = $this->findOrFail($id);
        $this->restauranteRepository->delete($restaurante);
    }

    public function findOrFail(int $id): Restaurante
    {
        $restaurante = $this->restauranteRepository->find($id);
        if (!$restaurante) {
            throw new RestauranteNotFoundException();
        }

        return $restaurante;
    }
}
