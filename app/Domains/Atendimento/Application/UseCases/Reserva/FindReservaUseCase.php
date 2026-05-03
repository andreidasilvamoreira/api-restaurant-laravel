<?php

namespace App\Domains\Atendimento\Application\UseCases\Reserva;

use App\Domains\Atendimento\Application\Exceptions\Reserva\ReservaNotFoundException;
use App\Domains\Atendimento\Application\Mappers\ReservaMapper;
use App\Domains\Atendimento\Domain\Repositories\ReservaRepositoryInterface;

class FindReservaUseCase
{
    public function __construct(
        protected ReservaRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        $reserva = $this->repository->find($id);

        if (!$reserva) {
            throw new ReservaNotFoundException();
        }

        return ReservaMapper::toOutput($reserva);
    }
}
