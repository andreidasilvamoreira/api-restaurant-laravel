<?php

namespace App\Domains\Atendimento\Application\DTOs\Cliente;

class ClienteOutput
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $telefone,
        public readonly ?string $endereco,
        public readonly int $user_id,
    ) {}
}
