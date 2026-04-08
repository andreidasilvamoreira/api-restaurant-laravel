<?php

namespace App\Domains\Restaurant\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Restaurant\Application\Exceptions\Restaurante\RestauranteNotFoundException;
use App\Domains\Restaurant\Domain\Entities\Restaurant;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;
use App\Domains\Restaurant\Infrastructure\Persistence\Mappers\RestaurantModelMapper;
use App\Models\Restaurante as RestauranteModel;
use App\Models\User;

class EloquentRestaurantRepository implements RestaurantRepositoryInterface
{
    public function findVisibleByUser(User $user): array
    {
        $query = RestauranteModel::query();

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('users', function ($q) use ($user) {
                $q->whereKey($user->id)
                    ->whereIn('restaurante_users.role', ['DONO', 'FUNCIONARIO', 'ADMIN']);
            });
        }

        return $query->get()->map(fn (RestauranteModel $model) => RestaurantModelMapper::toEntity($model))->all();
    }

    public function findById(int $id): ?Restaurant
    {
        $model = RestauranteModel::query()->find($id);

        if (!$model) {
            return null;
        }

        return RestaurantModelMapper::toEntity($model);
    }

    public function create(Restaurant $restaurant): Restaurant
    {
        $model = RestauranteModel::query()->create(RestaurantModelMapper::entityToArray($restaurant));
        return RestaurantModelMapper::toEntity($model);
    }

    public function update(Restaurant $restaurant): Restaurant
    {
        $model = RestauranteModel::query()->findOrFail($restaurant->getId());
        $model->update(
            RestaurantModelMapper::entityToArray($restaurant)
        );
        return RestaurantModelMapper::toEntity($model->fresh());
    }

    public function delete(int $id) : void
    {
        $model = RestauranteModel::query()->findOrFail($id);
        $model->delete();
    }

    public function findOrFail(int $id): Restaurant
    {
        $restaurante = $this->findById($id);
        if (!$restaurante) {
            throw new RestauranteNotFoundException('Restaurante não encontrado.');
        }

        return $restaurante;
    }
}
