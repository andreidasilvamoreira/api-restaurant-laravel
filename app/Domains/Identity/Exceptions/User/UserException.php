<?php

namespace App\Domains\Identity\Exceptions\User;

use Exception;

class UserException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return "USER_NOT_FOUND";
    }
}
