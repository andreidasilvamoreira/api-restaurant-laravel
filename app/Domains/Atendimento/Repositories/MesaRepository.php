<?php

namespace App\Domains\Atendimento\Repositories;

use App\Models\Mesa;
use App\Models\User;
use Illuminate\Support\Collection;

class MesaRepository
{
    public function findAll(User $user): Collection
    {
        $query = Mesa::query();

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('restaurante', function ($q) use ($user) {
                $q->whereHas('users', function ($q2) use ($user) {
                    $q2->whereKey($user->id)->whereIn('restaurante_users.role', ['ADMIN', 'DONO']);
                });
            });
        }
        return $query->get();
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
