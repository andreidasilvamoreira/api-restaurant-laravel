<?php

namespace App\Domains\Restaurant\Application\UseCases\Restaurante;

use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;

class DeleteRestauranteUseCase
{
    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
    public function execute(int $id): void
    {
        $this->repository->findOrFail($id);
        $this->repository->delete($id);
    }
}
