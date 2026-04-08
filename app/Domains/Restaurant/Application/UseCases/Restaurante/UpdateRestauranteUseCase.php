<?php

namespace App\Domains\Restaurant\Application\UseCases\Restaurante;

use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\UpdateRestauranteInput;
use App\Domains\Restaurant\Application\Mappers\RestaurantMapper;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;

class UpdateRestauranteUseCase
{

    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
    public function execute(UpdateRestauranteInput $input): RestauranteOutput
    {
        $restaurant = $this->repository->findOrFail($input->id);

        if ($input->name !== null) {
            $restaurant->setName($input->name);
        }

        if ($input->description !== null) {
            $restaurant->setDescription($input->description);
        }

        if ($input->active !== null) {
            $restaurant->setActive($input->active);
        }

        $restaurant = $this->repository->update($restaurant);

        return RestaurantMapper::toOutput($restaurant);

    }
}
