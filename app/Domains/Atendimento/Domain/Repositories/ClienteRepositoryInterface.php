<?php

namespace App\Domains\Atendimento\Domain\Repositories;

use App\Models\Cliente;
use Illuminate\Support\Collection;

interface ClienteRepositoryInterface
{
    public function findAll(): Collection;
    public function find(int $id): ?Cliente;
    public function create(array $data): Cliente;
    public function update(Cliente $cliente, array $data): Cliente;
    public function delete(Cliente $cliente): void;
}
