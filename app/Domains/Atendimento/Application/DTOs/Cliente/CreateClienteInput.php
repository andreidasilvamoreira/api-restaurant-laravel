<?php

namespace App\Domains\Atendimento\Application\DTOs\Cliente;

class CreateClienteInput
{
    public function __construct(
        public readonly ?string $telefone,
        public readonly ?string $endereco,
        public readonly int $userId,
    ) {}
}
