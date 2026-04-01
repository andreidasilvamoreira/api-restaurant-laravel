<?php

namespace App\Domains\Restaurant\Application\Exceptions\Restaurante;

class RestauranteNotFoundException extends RestauranteException
{
    protected $message = "Restaurant não encontrado";

    public function getStatus(): int
    {
        return 404;
    }

    public function getErrorCode(): string
    {
        return "RESTAURANTE_NOT_FOUND";
    }
}
