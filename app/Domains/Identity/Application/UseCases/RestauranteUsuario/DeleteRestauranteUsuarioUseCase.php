<?php

namespace App\Domains\Identity\Application\UseCases\RestauranteUsuario;

use App\Domains\Identity\Domain\Repositories\RestauranteUsuarioRepositoryInterface;
use DomainException;

class DeleteRestauranteUsuarioUseCase
{
    public function __construct(
        protected RestauranteUsuarioRepositoryInterface $repository
    ) {}

    public function execute(int $restauranteId, int $userId): void
    {
        if (!$this->repository->exists($restauranteId, $userId)) {
            throw new DomainException('Usuário não pertence a esse restaurante');
        }

        $this->repository->detach($restauranteId, $userId);
    }
}
