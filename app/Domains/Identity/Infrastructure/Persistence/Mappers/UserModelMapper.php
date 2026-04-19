<?php

namespace App\Domains\Identity\Infrastructure\Persistence\Mappers;

use App\Domains\Identity\Domain\Entities\User;
use App\Models\User as UserModel;

class UserModelMapper
{
    public static function toEntity(UserModel $model): User
    {
        return new User(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            password: null,
            role: $model->role,
        );
    }

    public static function entityToArray(User $user): array
    {
        $data = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
        ];

        if ($user->getPassword() !== null) {
            $data['password'] = $user->getPassword();
        }

        return $data;
    }
}
