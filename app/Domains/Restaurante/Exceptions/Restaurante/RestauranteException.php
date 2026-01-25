<?php

namespace App\Domains\Restaurante\Exceptions\Restaurante;

use Exception;

class RestauranteException extends Exception
{
    function getStatus(): int
    {
        return 422;
    }

    function getErrorCode(): string
    {
        return "RESTAURANTO_NOT_FOUND";
    }
}
