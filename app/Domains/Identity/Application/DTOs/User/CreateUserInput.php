<?php

namespace App\Domains\Identity\Application\DTOs\User;

class CreateUserInput
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?string $role,
    ) {}
}
