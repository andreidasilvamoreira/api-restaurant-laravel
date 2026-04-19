<?php

namespace App\Domains\Identity\Application\UseCases\RestauranteUsuario;

use App\Domains\Identity\Application\DTOs\RestauranteUsuario\CreateRestauranteUsuarioInput;
use App\Domains\Identity\Application\Mappers\RestauranteUsuarioMapper;
use App\Domains\Identity\Domain\Repositories\RestauranteUsuarioRepositoryInterface;
use App\Domains\Identity\Domain\Repositories\UserRepositoryInterface;
use DomainException;

class CreateRestauranteUsuarioUseCase
{
    public function __construct(
        protected RestauranteUsuarioRepositoryInterface $repository,
        protected UserRepositoryInterface $userRepository,
    ) {}

    public function execute(CreateRestauranteUsuarioInput $input): void
    {
        $this->userRepository->findOrFail($input->userId);

        if ($this->repository->exists($input->restauranteId, $input->userId)) {
            throw new DomainException('Usuário já pertence a esse restaurante');
        }

        $restauranteUsuario = RestauranteUsuarioMapper::toEntity($input);

        $this->repository->attach($restauranteUsuario);
    }
}
