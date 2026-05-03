<?php

namespace App\Domains\Atendimento\Application\UseCases\Reserva;

use App\Domains\Atendimento\Application\DTOs\Reserva\UpdateReservaInput;
use App\Domains\Atendimento\Application\Exceptions\Reserva\ReservaNotFoundException;
use App\Domains\Atendimento\Application\Mappers\ReservaMapper;
use App\Domains\Atendimento\Domain\Repositories\ReservaRepositoryInterface;

class UpdateReservaUseCase
{
    public function __construct(
        protected ReservaRepositoryInterface $repository
    ) {}

    public function execute(UpdateReservaInput $input)
    {
        $reserva = $this->repository->find($input->id);

        if (!$reserva) {
            throw new ReservaNotFoundException();
        }

        $reserva = $this->repository->update($input->changes, $reserva);

        return ReservaMapper::toOutput($reserva);
    }
}
