<?php

namespace App\Domains\Identity\Application\DTOs\User;

class UserOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
    ) {}
}
