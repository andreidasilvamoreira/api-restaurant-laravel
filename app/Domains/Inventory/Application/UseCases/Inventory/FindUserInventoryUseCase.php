<?php

namespace App\Domains\Inventory\Application\UseCases\Inventory;

use App\Domains\Inventory\Application\DTOs\Inventario\InventoryOutput;
use App\Domains\Inventory\Application\Mappers\InventoryMapper;
use App\Domains\Inventory\Domain\Repositories\InventoryRepositoryInterface;
use App\Models\User;

class FindUserInventoryUseCase
{
    public function __construct( protected InventoryRepositoryInterface $repository ) {}

    public function execute(User $user): array
    {
        $inventory = $this->repository->findVisibleByUser($user);

        return array_map(
            fn ($inventory) => InventoryMapper::entityToOutput($inventory),
            $inventory
        );
    }
}
