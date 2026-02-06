<?php

namespace App\Domains\Inventario\Repositories;

use App\Models\Inventario;
use App\Models\User;
use Illuminate\Support\Collection;

class InventarioRepository
{
    public function findAll(User $user): Collection
    {
        $query = Inventario::query()->with('restaurante');

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('restaurante', function ($q) use ($user) {
                $q->whereHas('users', function ($q2) use ($user) {
                    $q2->whereKey($user->id)->whereIn('restaurante_users.role', ['DONO', 'FUNCIONARIO', 'ADMIN']);
                });
            });
        }

        return $query->get();
    }

    public function find(int $id): ?Inventario
    {
        return Inventario::find($id);
    }

    public function create(array $data): Inventario
    {
        return Inventario::create($data);
    }

    public function update(array $data, Inventario $inventario): Inventario
    {
        $inventario->update($data);
        return $inventario;
    }

    public function delete(Inventario $inventario): void
    {
        $inventario->delete();
    }
}
