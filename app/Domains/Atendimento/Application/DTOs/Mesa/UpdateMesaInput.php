<?php

namespace App\Domains\Atendimento\Application\DTOs\Mesa;

class UpdateMesaInput
{
    public function __construct(
        public readonly int $id,
        public readonly array $changes,
    ) {}
}
