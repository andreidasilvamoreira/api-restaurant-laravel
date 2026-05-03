<?php

namespace App\Domains\Atendimento\Application\DTOs\Cliente;

class UpdateClienteInput
{
    public function __construct(
        public readonly int $id,
        public readonly array $changes,
    ) {}
}
