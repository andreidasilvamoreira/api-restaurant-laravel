<?php

namespace App\Domains\Identity\Application\UseCases\User;

use App\Domains\Identity\Application\DTOs\User\UserOutput;
use App\Domains\Identity\Application\Mappers\UserMapper;
use App\Domains\Identity\Domain\Repositories\UserRepositoryInterface;

class FindUserUseCase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function execute(int $id): UserOutput
    {
        $user = $this->repository->findOrFail($id);

        return UserMapper::toOutput($user);
    }
}
