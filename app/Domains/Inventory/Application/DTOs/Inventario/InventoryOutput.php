<?php

namespace App\Domains\Inventory\Application\DTOs\Inventario;

class InventoryOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $unit,
        public readonly float $currentQuantity,
        public readonly float $costPrice,
        public readonly int $restaurantId,
        public readonly int $supplierId
    ) {}
}
