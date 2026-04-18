<?php

namespace App\Domains\Inventory\Application\DTOs\Inventario;

class CreateInventoryInput
{
    public function __construct(
        public readonly string $name,
        public readonly string $unit,
        public readonly float $currentQuantity,
        public readonly float $costPrice,
        public readonly int $restaurantId,
        public readonly int $supplierId
    ) {}
}
