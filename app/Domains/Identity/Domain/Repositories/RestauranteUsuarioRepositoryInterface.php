<?php

namespace App\Domains\Identity\Domain\Repositories;

use App\Domains\Identity\Domain\Entities\RestauranteUsuario;

interface RestauranteUsuarioRepositoryInterface
{
    public function listByRestaurant(int $restauranteId): array;
    public function attach(RestauranteUsuario $restauranteUsuario): void;
    public function detach(int $restauranteId, int $userId): void;
    public function update(RestauranteUsuario $restauranteUsuario): void;
    public function exists(int $restauranteId, int $userId): bool;
}
