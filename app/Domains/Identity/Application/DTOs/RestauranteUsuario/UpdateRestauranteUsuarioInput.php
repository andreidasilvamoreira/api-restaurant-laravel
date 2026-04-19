<?php

namespace App\Domains\Identity\Application\DTOs\RestauranteUsuario;

class UpdateRestauranteUsuarioInput
{
    public function __construct(
        public readonly int $restauranteId,
        public readonly int $userId,
        public readonly ?string $role,
        public readonly ?bool $active,
    ) {}
}
