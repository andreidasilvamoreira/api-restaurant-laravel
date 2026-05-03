<?php

namespace App\Domains\Atendimento\Application\DTOs\Mesa;

class MesaOutput
{
    public function __construct(
        public readonly int $id,
        public readonly int $numero,
        public readonly int $capacidade,
        public readonly string $status,
        public readonly int $restaurante_id,
    ) {}
}
