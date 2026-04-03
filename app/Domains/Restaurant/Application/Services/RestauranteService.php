<?php

namespace App\Domains\Restaurant\Application\Services;

use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;

class RestauranteService
{
    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) {}
}
