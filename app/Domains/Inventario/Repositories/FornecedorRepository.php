<?php

namespace App\Domains\Inventario\Repositories;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Support\Collection;

class FornecedorRepository
{
    public function findAll(User $user): Collection
    {
        $query = Fornecedor::query()->with('restaurante');

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('restaurante', function ($q) use ($user) {
                $q->whereHas('users', function ($q2) use ($user) {
                    $q2->whereKey($user->id)->whereIn('restaurante_users.role', ['DONO', 'ADMIN']);
                });
            });
        }
        return $query->get();
    }

    public function find(int $id): ?Fornecedor
    {
        return Fornecedor::find($id);
    }

    public function create(array $data): Fornecedor
    {
        return Fornecedor::create($data);
    }

    public function update(array $data, Fornecedor $fornecedor): Fornecedor
    {
        $fornecedor->update($data);
        return $fornecedor;
    }

    public function delete(Fornecedor $fornecedor): void
    {
        $fornecedor->delete();
    }
}
