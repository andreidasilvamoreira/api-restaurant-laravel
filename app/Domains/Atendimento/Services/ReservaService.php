<?php

namespace App\Domains\Atendimento\Services;

use App\Domains\Atendimento\Exceptions\Reserva\ReservaNotFoundException;
use App\Domains\Atendimento\Repositories\ReservaRepository;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Support\Collection;

class ReservaService
{
    protected ReservaRepository $reservaRepository;
    public function __construct(ReservaRepository $reservaRepository)
    {
        $this->reservaRepository = $reservaRepository;
    }

    public function findAll(User $user): Collection
    {
        return $this->reservaRepository->findAll($user);
    }

    public function find(int $id): Reserva
    {
        return $this->findOrFail($id);
    }

    public function create(array $data): Reserva
    {
        return $this->reservaRepository->create($data);
    }

    public function update(array $data, int $id): Reserva
    {
        $reserva = $this->findOrFail($id);
        return $this->reservaRepository->update($data, $reserva);
    }

    public function delete(int $id): void
    {
        $reserva = $this->findOrFail($id);
        $reserva->delete();
    }

    public function findOrFail(int $id): Reserva
    {
        $reserva = $this->reservaRepository->find($id);
        if (!$reserva) {
            throw new ReservaNotFoundException();
        }

        return $reserva;
    }
}
