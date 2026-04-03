<?php

namespace App\Domains\Restaurant\Application\UseCases\Restaurante;

use App\Domains\Restaurant\Application\DTOs\Restaurante\CreateRestauranteInput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Domain\Entities\Restaurant;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;

class CreateRestauranteUseCase
{
    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
    public function execute(CreateRestauranteInput $data): RestauranteOutput
    {
        $restaurant = new Restaurant(
            id: null,
            name: $data->name,
            description: $data->description,
            active: $data->active ?? true
        );

        $restaurant = $this->repository->create($restaurant);

        return new RestauranteOutput(
          id: $restaurant->getId(),
          name: $restaurant->getName(),
          description: $restaurant->getDescription(),
          active: $restaurant->isActive()
        );
    }
}
