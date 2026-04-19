<?php

namespace App\Domains\Identity\Application\Mappers;

use App\Domains\Identity\Application\DTOs\User\CreateUserInput;
use App\Domains\Identity\Application\DTOs\User\UserOutput;
use App\Domains\Identity\Domain\Entities\User;
use App\Models\User as UserModel;

class UserMapper
{
    public static function toEntity(CreateUserInput $input): User
    {
        return new User(
            id: null,
            name: $input->name,
            email: $input->email,
            password: $input->password,
            role: $input->role ?? UserModel::ROLE_CLIENTE,
        );
    }

    public static function toOutput(User $user): UserOutput
    {
        return new UserOutput(
            id: $user->getId(),
            name: $user->getName(),
            email: $user->getEmail(),
            role: $user->getRole(),
        );
    }
}
