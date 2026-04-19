<?php

namespace App\Domains\Identity\Application\UseCases\User;

use App\Domains\Identity\Application\DTOs\User\CreateUserInput;
use App\Domains\Identity\Application\DTOs\User\UserOutput;
use App\Domains\Identity\Application\Mappers\UserMapper;
use App\Domains\Identity\Domain\Repositories\UserRepositoryInterface;

class CreateUserUseCase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function execute(CreateUserInput $input): UserOutput
    {
        $user = UserMapper::toEntity($input);

        $user = $this->repository->create($user);

        return UserMapper::toOutput($user);
    }
}
