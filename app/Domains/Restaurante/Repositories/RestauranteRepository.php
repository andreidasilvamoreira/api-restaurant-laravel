<?php

namespace App\Domains\Restaurante\Repositories;

use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RestauranteRepository
{
    public function findAll(User $user): Collection
    {
        $query = Restaurante::query();

        if ($user->role !== 'SUPER_ADMIN') {
            $query->whereHas('users', function ($q) use ($user){
                $q->where('users.id', $user->id)->whereIn('restaurante_users.role', ['DONO', 'FUNCIONARIO', 'ADMIN']);
            });
        };

        return $query->get();
    }

    public function find($id): Restaurante
    {
        return Restaurante::find($id);
    }

    public function create(array $data): Restaurante
    {
        return Restaurante::create($data);
    }

    public function update(Restaurante $restaurante, array $data): Restaurante
    {
        $restaurante->update($data);
        return $restaurante;
    }

    public function delete(Restaurante $restaurante) : void
    {
        $restaurante->delete();
    }
}
