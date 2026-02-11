<?php

namespace App\Domains\Atendimento\Services;

use App\Domains\Atendimento\Exceptions\Mesa\MesaNotFoundException;
use App\Domains\Atendimento\Repositories\MesaRepository;
use App\Models\Mesa;
use App\Models\User;
use Illuminate\Support\Collection;

class MesaService
{
    protected MesaRepository $mesaRepository;
    public function __construct(MesaRepository $mesaRepository)
    {
        $this->mesaRepository = $mesaRepository;
    }

    public function findAll(User $user): Collection
    {
        return $this->mesaRepository->findAll($user);
    }

    public function find(int $id): ?Mesa
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
