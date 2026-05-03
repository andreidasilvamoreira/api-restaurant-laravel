<?php

namespace App\Domains\Atendimento\Application\DTOs\Reserva;

class CreateReservaInput
{
    public function __construct(
        public readonly string $dataReserva,
        public readonly int $numeroPessoas,
        public readonly string $status,
        public readonly ?int $mesaId,
        public readonly int $clienteId,
        public readonly int $restauranteId,
    ) {}
}
