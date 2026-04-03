<?php

namespace App\Domains\Restaurant\Application\UseCases\Restaurante;

use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\UpdateRestauranteInput;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;

class UpdateRestauranteUseCase
{

    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
    public function execute(UpdateRestauranteInput $data): RestauranteOutput
    {
        $restaurant = $this->repository->findOrFail($data->id);

        if ($data->name !== null) {
            $restaurant->setName($data->name);
        }

        if ($data->description !== null) {
            $restaurant->setDescription($data->description);
        }

        if ($data->active !== null) {
            $restaurant->setActive($data->active);
        }

        $restaurant = $this->repository->update($restaurant);

        return new RestauranteOutput(
            id: $restaurant->getId(),
            name: $restaurant->getName(),
            description: $restaurant->getDescription(),
            active: $restaurant->isActive()
        );
    }
}
