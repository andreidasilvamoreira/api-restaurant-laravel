<?php

namespace App\Domains\Atendimento\Application\UseCases\Reserva;

use App\Domains\Atendimento\Application\DTOs\Reserva\CreateReservaInput;
use App\Domains\Atendimento\Application\Mappers\ReservaMapper;
use App\Domains\Atendimento\Domain\Repositories\ReservaRepositoryInterface;

class CreateReservaUseCase
{
    public function __construct(
        protected ReservaRepositoryInterface $repository
    ) {}

    public function execute(CreateReservaInput $input)
    {
        $reserva = $this->repository->create([
            'data_reserva' => $input->dataReserva,
            'numero_pessoas' => $input->numeroPessoas,
            'status' => $input->status,
            'mesa_id' => $input->mesaId,
            'cliente_id' => $input->clienteId,
            'restaurante_id' => $input->restauranteId,
        ]);

        return ReservaMapper::toOutput($reserva);
    }
}
