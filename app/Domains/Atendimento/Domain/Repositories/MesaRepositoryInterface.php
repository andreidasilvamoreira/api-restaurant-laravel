<?php

namespace App\Domains\Atendimento\Domain\Repositories;

use App\Models\Mesa;
use App\Models\User;
use Illuminate\Support\Collection;

interface MesaRepositoryInterface
{
    public function findAll(User $user, ?int $restauranteId = null): Collection;
    public function find(int $id): ?Mesa;
    public function create(array $data): Mesa;
    public function update(array $data, Mesa $mesa): Mesa;
    public function delete(Mesa $mesa): void;
}
