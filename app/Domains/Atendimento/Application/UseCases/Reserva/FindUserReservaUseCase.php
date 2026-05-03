<?php

namespace App\Domains\Atendimento\Application\UseCases\Reserva;

use App\Domains\Atendimento\Application\Mappers\ReservaMapper;
use App\Domains\Atendimento\Domain\Repositories\ReservaRepositoryInterface;
use App\Models\User;

class FindUserReservaUseCase
{
    public function __construct(
        protected ReservaRepositoryInterface $repository
    ) {}

    public function execute(User $user, ?int $restauranteId = null): array
    {
        return array_map(
            fn ($reserva) => ReservaMapper::toOutput($reserva),
            $this->repository->findAll($user, $restauranteId)->all()
        );
    }
}
