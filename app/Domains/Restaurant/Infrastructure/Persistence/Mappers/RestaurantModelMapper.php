<?php

namespace App\Domains\Restaurant\Infrastructure\Persistence\Mappers;

use App\Domains\Restaurant\Application\DTOs\Restaurante\CreateRestauranteInput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\RestauranteOutput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\UpdateRestauranteInput;
use App\Domains\Restaurant\Domain\Entities\Restaurant;
use App\Models\Restaurante as RestaurantModel;

class RestaurantModelMapper
{
    public static function toEntity(RestaurantModel $model): Restaurant
    {
        return new Restaurant(
            id: $model->id,
            name: $model->nome,
            description: $model->descricao,
            active: $model->ativo
        );
    }

    public static function toArray(RestaurantModel $model): array
    {
        return [
            'id' => $model->id,
            'nome' => $model->nome,
            'descricao' => $model->descricao,
            'ativo' => $model->ativo
        ];
    }

    public static function entityToArray(Restaurant $restaurant): array
    {
        return [
            'nome' => $restaurant->getName(),
            'descricao' => $restaurant->getDescription(),
            'ativo' => $restaurant->isActive()
        ];
    }


}
