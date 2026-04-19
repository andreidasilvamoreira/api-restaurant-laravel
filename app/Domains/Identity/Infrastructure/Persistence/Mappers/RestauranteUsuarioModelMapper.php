<?php

namespace App\Domains\Identity\Infrastructure\Persistence\Mappers;

use App\Domains\Identity\Domain\Entities\RestauranteUsuario;
use App\Models\RestauranteUser as RestauranteUsuarioModel;
use App\Models\User as UserModel;

class RestauranteUsuarioModelMapper
{
    public static function fromUserModel(UserModel $model, int $restauranteId): RestauranteUsuario
    {
        return new RestauranteUsuario(
            id: $model->pivot->id ?? null,
            restauranteId: $restauranteId,
            userId: $model->id,
            name: $model->name,
            role: $model->pivot->role,
            active: (bool) $model->pivot->ativo,
        );
    }

    public static function toEntity(RestauranteUsuarioModel $model): RestauranteUsuario
    {
        return new RestauranteUsuario(
            id: $model->id,
            restauranteId: $model->restaurante_id,
            userId: $model->user_id,
            name: $model->user?->name ?? '',
            role: $model->role,
            active: (bool) $model->ativo,
        );
    }

    public static function entityToArray(RestauranteUsuario $restauranteUsuario): array
    {
        return [
            'user_id' => $restauranteUsuario->getUserId(),
            'restaurante_id' => $restauranteUsuario->getRestauranteId(),
            'role' => $restauranteUsuario->getRole(),
            'ativo' => $restauranteUsuario->isActive(),
        ];
    }

    public static function updateArray(RestauranteUsuario $restauranteUsuario): array
    {
        return [
            'role' => $restauranteUsuario->getRole(),
            'ativo' => $restauranteUsuario->isActive(),
        ];
    }
}
