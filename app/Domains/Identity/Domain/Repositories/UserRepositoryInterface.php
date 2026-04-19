<?php

namespace App\Domains\Identity\Domain\Repositories;

use App\Domains\Identity\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findAll(): array;
    public function findById(int $id): ?User;
    public function create(User $user): User;
    public function update(User $user): User;
    public function delete(int $id): void;
    public function findOrFail(int $id): User;
}
