<?php

namespace App\Domains\Restaurant\Application\Mappers;

use App\Domains\Restaurant\Application\DTOs\Restaurante\CreateRestauranteInput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Domain\Entities\Restaurant;

class RestaurantMapper
{
    public static function ToEntity(CreateRestauranteInput $input): Restaurant
    {
        return new Restaurant(
            id: null,
            name: $input->name,
            description: $input->description,
            active: $input->active ?? true
        );
    }

    public static function toOutput(Restaurant $restaurant): RestauranteOutput
    {
        return new RestauranteOutput(
            id: $restaurant->getId(),
            name: $restaurant->getName(),
            description: $restaurant->getDescription(),
            active: $restaurant->isActive()
        );
    }
}
