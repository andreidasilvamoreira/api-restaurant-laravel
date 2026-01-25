<?php

namespace App\Domains\Restaurante\Repositories;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RestauranteRepository
{
    public function findAll(): Collection
    {
        return Restaurante::all();
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
