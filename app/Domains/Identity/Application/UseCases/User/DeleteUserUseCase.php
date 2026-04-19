<?php

namespace App\Domains\Identity\Application\UseCases\User;

use App\Domains\Identity\Domain\Repositories\UserRepositoryInterface;

class DeleteUserUseCase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        $this->repository->findOrFail($id);
        $this->repository->delete($id);
    }
}
