<?php

namespace App\Domains\Atendimento\Application\DTOs\Mesa;

class CreateMesaInput
{
    public function __construct(
        public readonly int $numero,
        public readonly int $capacidade,
        public readonly ?string $status,
        public readonly int $restauranteId,
    ) {}
}
