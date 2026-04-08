<?php

namespace App\Domains\Restaurant\Application\UseCases\Restaurante;

use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Application\Mappers\RestaurantMapper;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;
use App\Domains\Restaurant\Infrastructure\Persistence\Mappers\RestaurantModelMapper;

class FindRestauranteUseCase
{
    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
    public function execute(int $id): RestauranteOutput
    {
        $restaurant = $this->repository->findOrFail($id);

        return RestaurantMapper::toOutput($restaurant);
    }
}
