<?php

namespace App\Domains\Identity\Services;

use App\Domains\Identity\Exceptions\User\UserNotFoundException;
use App\Domains\Identity\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findAll(): Collection
    {
       return $this->userRepository->findAll();
    }

    public function find(int $id): User
    {
        return $this->findOrFail($id);
    }

    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function update(array $data, int $id): User
    {
        $user = $this->findOrFail($id);
        return $this->userRepository->update($user, $data);
    }

    public function delete(int $id): void
    {
        $user = $this->findOrFail($id);
        $this->userRepository->delete($user);
    }
    public function findOrFail(int $id): User
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
