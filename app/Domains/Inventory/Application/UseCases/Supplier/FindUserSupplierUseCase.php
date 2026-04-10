<?php

namespace App\Domains\Inventory\Application\UseCases\Supplier;

use App\Domains\Inventory\Application\Mappers\SupplierMapper;
use App\Domains\Inventory\Domain\Repositories\SupplierRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;

class FindUserSupplierUseCase
{
    public function __construct(protected SupplierRepositoryInterface $repository) {}
    public function execute(User $user): array
    {
        $supplier = $this->repository->findVisibleByUser($user);

        return array_map(
            fn ($supplier) => SupplierMapper::entityToOutput($supplier),
            $supplier
        );
    }
}
