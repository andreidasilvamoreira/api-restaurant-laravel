<?php

namespace App\Domains\Atendimento\Application\Services;

use App\Domains\Atendimento\Application\Exceptions\Mesa\MesaNotFoundException;
use App\Domains\Atendimento\Domain\Repositories\MesaRepositoryInterface;
use App\Models\Mesa;
use App\Models\User;
use Illuminate\Support\Collection;

class MesaService
{
    protected MesaRepositoryInterface $mesaRepository;
    public function __construct(MesaRepositoryInterface $mesaRepository)
    {
        $this->mesaRepository = $mesaRepository;
    }

    public function findAll(User $user, ?int $restauranteId = null): Collection
    {
        return $this->mesaRepository->findAll($user, $restauranteId);
    }

    public function find(int $id): Mesa
    {
        return $this->findOrFail($id);
    }

    public function create(array $data): Mesa
    {
        return $this->mesaRepository->create($data);
    }

    public function update(array $data, int $id): Mesa
    {
        $mesa = $this->findOrFail($id);
        return $this->mesaRepository->update($data, $mesa);
    }

    public function delete(int $id): void
    {
        $mesa = $this->findOrFail($id);
        $this->mesaRepository->delete($mesa);
    }

    public function findOrFail(int $id): Mesa
    {
        $mesa = $this->mesaRepository->find($id);
        if (!$mesa) {
            throw new MesaNotFoundException;
        }

        return $mesa;
    }
}
