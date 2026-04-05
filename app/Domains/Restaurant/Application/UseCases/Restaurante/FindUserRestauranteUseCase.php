<?php

namespace App\Domains\Restaurant\Application\UseCases\Restaurante;

use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;
use App\Models\User;

class FindUserRestauranteUseCase
{
    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
    public function execute(User $user): array
    {
        $restaurant = $this->repository->findVisibleByUser($user);

        return array_map(
            fn($restaurant) => new RestauranteOutput(
                id: $restaurant->getId(),
                name: $restaurant->getName(),
                description: $restaurant->getDescription(),
                active: $restaurant->isActive()
            ),
            $restaurant
        );
    }
}
