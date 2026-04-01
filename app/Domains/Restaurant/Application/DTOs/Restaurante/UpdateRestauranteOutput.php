<?php

namespace App\Domains\Restaurant\Application\DTOs\Restaurante;

class UpdateRestauranteOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $description,
        public readonly bool $active,
    ) {}
}
