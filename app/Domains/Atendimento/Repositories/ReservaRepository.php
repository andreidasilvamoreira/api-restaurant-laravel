<?php

namespace App\Domains\Atendimento\Repositories;

use App\Models\Mesa;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Support\Collection;

class ReservaRepository
{
    public function findAll(User $user): Collection
    {
        $query = Reserva::query();

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER'){
            $query->whereHas('restaurante.users', function ($q) use ($user) {
               $q->whereKey($user->id)->whereIn('restaurante_users.role', ['ADMIN', 'DONO']);
            });
        }
        return $query->get();
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
