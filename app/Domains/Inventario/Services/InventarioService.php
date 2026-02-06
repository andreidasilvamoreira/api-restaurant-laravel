<?php

namespace App\Domains\Inventario\Services;

use App\Domains\Inventario\Exceptions\Inventario\InventarioNotFoundException;
use App\Domains\Inventario\Repositories\InventarioRepository;
use App\Models\Inventario;
use App\Models\User;
use Illuminate\Support\Collection;

class InventarioService
{
    protected InventarioRepository $inventarioRepository;
    public function __construct(InventarioRepository $inventarioRepository)
    {
        $this->inventarioRepository = $inventarioRepository;
    }

    public function findAll(User $user): Collection
    {
        return $this->inventarioRepository->findAll($user);
    }

    public function find(int $id): ?Inventario
    {
        return $this->inventarioRepository->find($id);
    }

    public function create(array $data): Inventario
    {
        return $this->inventarioRepository->create($data);
    }

    public function update(array $data, int $id): Inventario
    {
        $inventario = $this->findOrFail($id);
        return $this->inventarioRepository->update($data, $inventario);
    }

    public function delete(int $id): void
    {
        $inventario = $this->findOrFail($id);
        $this->inventarioRepository->delete($inventario);
    }

    public function findOrFail(int $id): Inventario
    {
        $inventario = $this->inventarioRepository->find($id);
        if (! $inventario) {
            throw new InventarioNotFoundException();
        }

        return $inventario;
    }
}
