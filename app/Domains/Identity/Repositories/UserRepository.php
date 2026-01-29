<?php

namespace App\Domains\Identity\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    public function findAll(): Collection
    {
        return User::All();
    }

    public function find(int $id): User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
