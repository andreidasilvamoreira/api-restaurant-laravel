<?php

namespace App\Domains\Restaurant\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Restaurant\Domain\Entities\Restaurant;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;
use App\Domains\Restaurant\Infrastructure\Persistence\Mappers\RestaurantMapper;
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

        return $query->get()->map(fn (RestauranteModel $model) => RestaurantMapper::toEntity($model))->all();
    }

    public function findById(int $id): ?Restaurant
    {
        $model = RestauranteModel::query()->find($id);

        if (!$model) {
            return null;
        }

        return RestaurantMapper::toEntity($model);
    }

    public function create(Restaurant $restaurant): Restaurant
    {
        $model = RestauranteModel::query()->create(RestaurantMapper::entityToArray($restaurant));
        return RestaurantMapper::toEntity($model);
    }

    public function update(Restaurant $restaurant): Restaurant
    {
        $model = RestauranteModel::query()->findOrFail($restaurant->getId());
        $model->update(
            RestaurantMapper::entityToArray($restaurant)
        );
        return RestaurantMapper::toEntity($model->fresh());
    }

    public function delete(int $id) : void
    {
        $model = RestauranteModel::query()->findOrFail($id);
        $model->delete();
    }
}
