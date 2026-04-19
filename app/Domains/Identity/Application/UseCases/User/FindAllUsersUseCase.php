<?php

namespace App\Domains\Identity\Application\UseCases\User;

use App\Domains\Identity\Application\Mappers\UserMapper;
use App\Domains\Identity\Domain\Repositories\UserRepositoryInterface;

class FindAllUsersUseCase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        $users = $this->repository->findAll();

        return array_map(
            fn ($user) => UserMapper::toOutput($user),
            $users
        );
    }
}
