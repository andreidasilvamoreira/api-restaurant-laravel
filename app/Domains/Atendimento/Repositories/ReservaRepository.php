<?php

namespace App\Domains\Atendimento\Repositories;

use App\Models\Mesa;
use App\Models\Reserva;
use Illuminate\Support\Collection;

class ReservaRepository
{
    public function findAll(): Collection
    {
        return Mesa::all();
    }

    public function find(int $id): ?Reserva
    {
        return Reserva::find($id);
    }

    public function create(array $data): Reserva
    {
        return Reserva::create($data);
    }
    public function update(array $data, Reserva $reserva): Reserva
    {
        $reserva->update($data);
        return $reserva;
    }

    public function delete(Reserva $reserva): void
    {
        $reserva->delete();
    }
}
