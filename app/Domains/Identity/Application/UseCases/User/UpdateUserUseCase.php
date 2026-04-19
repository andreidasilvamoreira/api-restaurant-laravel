<?php

namespace App\Domains\Identity\Application\UseCases\User;

use App\Domains\Identity\Application\DTOs\User\UpdateUserInput;
use App\Domains\Identity\Application\DTOs\User\UserOutput;
use App\Domains\Identity\Application\Mappers\UserMapper;
use App\Domains\Identity\Domain\Repositories\UserRepositoryInterface;

class UpdateUserUseCase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function execute(UpdateUserInput $input): UserOutput
    {
        $user = $this->repository->findOrFail($input->id);

        if ($input->name !== null) {
            $user->setName($input->name);
        }

        if ($input->email !== null) {
            $user->setEmail($input->email);
        }

        if ($input->password !== null) {
            $user->setPassword($input->password);
        }

        if ($input->role !== null) {
            $user->setRole($input->role);
        }

        $user = $this->repository->update($user);

        return UserMapper::toOutput($user);
    }
}
