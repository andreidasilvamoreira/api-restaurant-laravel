<?php

namespace App\Domains\Atendimento\Application\DTOs\Reserva;

class UpdateReservaInput
{
    public function __construct(
        public readonly int $id,
        public readonly array $changes,
    ) {}
}
