<?php

namespace App\Domains\Inventory\Application\UseCases\Inventory;

use App\Domains\Inventory\Application\DTOs\Inventario\CreateInventoryInput;
use App\Domains\Inventory\Application\DTOs\Inventario\InventoryOutput;
use App\Domains\Inventory\Application\Mappers\InventoryMapper;
use App\Domains\Inventory\Domain\Repositories\InventoryRepositoryInterface;

class CreateInventoryUseCase
{
    public function __construct( protected InventoryRepositoryInterface $repository ) {}

    public function execute(CreateInventoryInput $input): InventoryOutput
    {
        $inventory = InventoryMapper::inputToEntity($input);
        $inventory = $this->repository->create($inventory);
        return InventoryMapper::entityToOutput($inventory);
    }
}
