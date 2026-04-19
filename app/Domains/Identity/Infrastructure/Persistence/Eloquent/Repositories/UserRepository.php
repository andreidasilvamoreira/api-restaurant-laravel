<?php

namespace App\Domains\Identity\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Identity\Application\Exceptions\User\UserNotFoundException;
use App\Domains\Identity\Domain\Entities\User;
use App\Domains\Identity\Domain\Repositories\UserRepositoryInterface;
use App\Domains\Identity\Infrastructure\Persistence\Mappers\UserModelMapper;
use App\Models\User as UserModel;

class UserRepository implements UserRepositoryInterface
{
    public function findAll(): array
    {
        return UserModel::query()
            ->get()
            ->map(fn (UserModel $model) => UserModelMapper::toEntity($model))
            ->all();
    }

    public function findById(int $id): ?User
    {
        $model = UserModel::query()->find($id);

        if (!$model) {
            return null;
        }

        return UserModelMapper::toEntity($model);
    }

    public function create(User $user): User
    {
        $model = UserModel::query()->create(UserModelMapper::entityToArray($user));

        return UserModelMapper::toEntity($model);
    }

    public function update(User $user): User
    {
        $model = UserModel::query()->findOrFail($user->getId());
        $model->update(UserModelMapper::entityToArray($user));

        return UserModelMapper::toEntity($model->fresh());
    }

    public function delete(int $id): void
    {
        $model = UserModel::query()->findOrFail($id);
        $model->delete();
    }

    public function findOrFail(int $id): User
    {
        $user = $this->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
