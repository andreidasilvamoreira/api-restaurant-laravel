<?php

namespace App\Domains\Atendimento\Application\DTOs\Reserva;

class ReservaOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $data_reserva,
        public readonly int $numero_pessoas,
        public readonly string $status,
        public readonly int $cliente_id,
        public readonly ?int $mesa_id,
        public readonly int $restaurante_id,
    ) {}
}
