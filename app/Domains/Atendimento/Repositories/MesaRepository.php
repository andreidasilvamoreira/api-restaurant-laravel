<?php

namespace App\Domains\Atendimento\Repositories;

use App\Models\Mesa;
use Illuminate\Support\Collection;

class MesaRepository
{
    public function findAll(): Collection
    {
        return Mesa::all();
    }

    public function find(int $id): ?Mesa
    {
        return Mesa::find($id);
    }

    public function create(array $data): Mesa
    {
        return Mesa::create($data);
    }

    public function update(array $data, Mesa $mesa): Mesa
    {
        $mesa->update($data);
        return $mesa;
    }

    public function delete(Mesa $mesa): void
    {
        $mesa->delete();
    }
}
