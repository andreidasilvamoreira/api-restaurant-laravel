<?php

namespace App\Domains\Identity\Application\Mappers;

use App\Domains\Identity\Application\DTOs\RestauranteUsuario\CreateRestauranteUsuarioInput;
use App\Domains\Identity\Application\DTOs\RestauranteUsuario\RestauranteUsuarioOutput;
use App\Domains\Identity\Domain\Entities\RestauranteUsuario;

class RestauranteUsuarioMapper
{
    public static function toEntity(CreateRestauranteUsuarioInput $input): RestauranteUsuario
    {
        return new RestauranteUsuario(
            id: null,
            restauranteId: $input->restauranteId,
            userId: $input->userId,
            name: '',
            role: $input->role,
            active: $input->active,
        );
    }

    public static function toOutput(RestauranteUsuario $restauranteUsuario): RestauranteUsuarioOutput
    {
        return new RestauranteUsuarioOutput(
            userId: $restauranteUsuario->getUserId(),
            name: $restauranteUsuario->getName(),
            role: $restauranteUsuario->getRole(),
            active: $restauranteUsuario->isActive(),
        );
    }
}
