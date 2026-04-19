<?php

namespace App\Domains\Identity\Application\UseCases\RestauranteUsuario;

use App\Domains\Identity\Application\Mappers\RestauranteUsuarioMapper;
use App\Domains\Identity\Domain\Repositories\RestauranteUsuarioRepositoryInterface;

class FindRestauranteUsuarioUseCase
{
    public function __construct(
        protected RestauranteUsuarioRepositoryInterface $repository
    ) {}

    public function execute(int $restauranteId): array
    {
        $usuarios = $this->repository->listByRestaurant($restauranteId);

        return array_map(
            fn ($usuario) => RestauranteUsuarioMapper::toOutput($usuario),
            $usuarios
        );
    }
}
