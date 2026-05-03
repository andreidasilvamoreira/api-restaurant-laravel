<?php

namespace App\Domains\Atendimento\Domain\Repositories;

use App\Models\Reserva;
use App\Models\User;
use Illuminate\Support\Collection;

interface ReservaRepositoryInterface
{
    public function findAll(User $user, ?int $restauranteId = null): Collection;
    public function find(int $id): ?Reserva;
    public function create(array $data): Reserva;
    public function update(array $data, Reserva $reserva): Reserva;
    public function delete(Reserva $reserva): void;
}
