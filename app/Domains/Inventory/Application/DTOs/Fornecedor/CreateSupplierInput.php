<?php

namespace App\Domains\Inventory\Application\DTOs\Fornecedor;

class CreateSupplierInput
{
    public function __construct(
        public readonly string $name,
        public readonly string $phone,
        public readonly string $email,
        public readonly string $address,
        public readonly int $restaurantId
    ) {}
}
