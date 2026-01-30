<?php

namespace App\Domains\Identity\Exceptions\User;

class UserNotFoundException extends UserException
{
    protected $message = "User não encontrado";

    public function getStatus(): int
    {
        return 404;
    }

    public function getErrorCode(): string
    {
        return "USER_NOT_FOUND";
    }
}
