<?php

namespace App\Domains\Atendimento\Application\UseCases\Reserva;

use App\Domains\Atendimento\Application\Exceptions\Reserva\ReservaNotFoundException;
use App\Domains\Atendimento\Domain\Repositories\ReservaRepositoryInterface;

class DeleteReservaUseCase
{
    public function __construct(
        protected ReservaRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        $reserva = $this->repository->find($id);

        if (!$reserva) {
            throw new ReservaNotFoundException();
        }

        $this->repository->delete($reserva);
    }
}
