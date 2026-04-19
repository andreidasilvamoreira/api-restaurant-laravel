<?php

namespace App\Domains\Identity\Application\UseCases\RestauranteUsuario;

use App\Domains\Identity\Application\DTOs\RestauranteUsuario\UpdateRestauranteUsuarioInput;
use App\Domains\Identity\Domain\Repositories\RestauranteUsuarioRepositoryInterface;
use DomainException;

class UpdateRestauranteUsuarioUseCase
{
    public function __construct(
        protected RestauranteUsuarioRepositoryInterface $repository
    ) {}

    public function execute(UpdateRestauranteUsuarioInput $input): void
    {
        if (!$this->repository->exists($input->restauranteId, $input->userId)) {
            throw new DomainException('Usuário não pertence a esse restaurante');
        }

        $restauranteUsuario = $this->repository->listByRestaurant($input->restauranteId);
        $restauranteUsuario = collect($restauranteUsuario)
            ->first(fn ($usuario) => $usuario->getUserId() === $input->userId);

        if ($restauranteUsuario === null) {
            throw new DomainException('Usuário não pertence a esse restaurante');
        }

        if ($input->role !== null) {
            $restauranteUsuario->setRole($input->role);
        }

        if ($input->active !== null) {
            $restauranteUsuario->setActive($input->active);
        }

        $this->repository->update($restauranteUsuario);
    }
}
