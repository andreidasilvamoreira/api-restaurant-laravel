<?php

namespace App\Domains\Restaurant\Application\UseCases\Restaurante;

use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;

class FindRestauranteUseCase
{
    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
    public function execute(int $id): RestauranteOutput
    {
        $restaurant = $this->repository->findOrFail($id);

        return new RestauranteOutput(
            id: $restaurant->getId(),
            name: $restaurant->getName(),
            description: $restaurant->getDescription(),
            active: $restaurant->isActive()
        );
    }
}
