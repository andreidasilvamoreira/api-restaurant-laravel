<?php

namespace App\Domains\Atendimento\Application\UseCases\Mesa;

use App\Domains\Atendimento\Application\Mappers\MesaMapper;
use App\Domains\Atendimento\Domain\Repositories\MesaRepositoryInterface;
use App\Models\User;

class FindUserMesaUseCase
{
    public function __construct(
        protected MesaRepositoryInterface $repository
    ) {}

    public function execute(User $user, ?int $restauranteId = null): array
    {
        return array_map(
            fn ($mesa) => MesaMapper::toOutput($mesa),
            $this->repository->findAll($user, $restauranteId)->all()
        );
    }
}
