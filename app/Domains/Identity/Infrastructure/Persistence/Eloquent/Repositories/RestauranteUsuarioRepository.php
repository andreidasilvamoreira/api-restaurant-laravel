<?php

namespace App\Domains\Identity\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Identity\Domain\Entities\RestauranteUsuario;
use App\Domains\Identity\Domain\Repositories\RestauranteUsuarioRepositoryInterface;
use App\Domains\Identity\Infrastructure\Persistence\Mappers\RestauranteUsuarioModelMapper;
use App\Models\Restaurante;
use App\Models\RestauranteUser as RestauranteUsuarioModel;

class RestauranteUsuarioRepository implements RestauranteUsuarioRepositoryInterface
{
    public function attach(RestauranteUsuario $restauranteUsuario): void
    {
        RestauranteUsuarioModel::query()->create(
            RestauranteUsuarioModelMapper::entityToArray($restauranteUsuario)
        );
    }

    public function detach(int $restauranteId, int $userId): void
    {
        RestauranteUsuarioModel::query()
            ->where('restaurante_id', $restauranteId)
            ->where('user_id', $userId)
            ->delete();
    }

    public function update(RestauranteUsuario $restauranteUsuario): void
    {
        RestauranteUsuarioModel::query()
            ->where('restaurante_id', $restauranteUsuario->getRestauranteId())
            ->where('user_id', $restauranteUsuario->getUserId())
            ->update(RestauranteUsuarioModelMapper::updateArray($restauranteUsuario));
    }

    public function exists(int $restauranteId, int $userId): bool
    {
        return RestauranteUsuarioModel::query()
            ->where('restaurante_id', $restauranteId)
            ->where('user_id', $userId)
            ->exists();
    }

    public function listByRestaurant(int $restauranteId): array
    {
        $restaurante = Restaurante::query()->findOrFail($restauranteId);

        return $restaurante->users()
            ->withPivot(['id', 'role', 'ativo'])
            ->get()
            ->map(fn ($model) => RestauranteUsuarioModelMapper::fromUserModel($model, $restauranteId))
            ->all();
    }
}
