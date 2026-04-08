<?php

namespace App\Domains\Restaurant\Application\UseCases\Restaurante;

use App\Domains\Restaurant\Application\DTOs\Restaurante\CreateRestauranteInput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Application\Mappers\RestaurantMapper;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;

class CreateRestauranteUseCase
{
    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
    public function execute(CreateRestauranteInput $input): RestauranteOutput
    {
        $restaurant = RestaurantMapper::toEntity($input);

        $restaurant = $this->repository->create($restaurant);

        return RestaurantMapper::toOutput($restaurant);

    }
}
