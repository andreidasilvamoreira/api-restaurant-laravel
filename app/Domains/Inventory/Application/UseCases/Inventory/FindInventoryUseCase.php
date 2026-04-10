<?php

namespace App\Domains\Inventory\Application\UseCases\Inventory;

use App\Domains\Inventory\Application\DTOs\Inventario\InventoryOutput;
use App\Domains\Inventory\Application\Mappers\InventoryMapper;
use App\Domains\Inventory\Domain\Repositories\InventoryRepositoryInterface;

class FindInventoryUseCase
{
    public function __construct( protected InventoryRepositoryInterface $repository ) {}

    public function execute(int $id): InventoryOutput
    {
        $inventory = $this->repository->findOrFail($id);
        return InventoryMapper::entityToOutput($inventory);
    }
}
