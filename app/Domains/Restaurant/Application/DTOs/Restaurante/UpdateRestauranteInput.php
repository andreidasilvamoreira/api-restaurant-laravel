<?php

namespace App\Domains\Restaurant\Application\DTOs\Restaurante;

class UpdateRestauranteInput
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
        public readonly bool $active,
    ) {}
}
