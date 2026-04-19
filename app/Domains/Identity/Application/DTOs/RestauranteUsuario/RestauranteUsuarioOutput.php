<?php

namespace App\Domains\Identity\Application\DTOs\RestauranteUsuario;

class RestauranteUsuarioOutput
{
    public function __construct(
        public readonly int $userId,
        public readonly string $name,
        public readonly string $role,
        public readonly bool $active,
    ) {}
}
