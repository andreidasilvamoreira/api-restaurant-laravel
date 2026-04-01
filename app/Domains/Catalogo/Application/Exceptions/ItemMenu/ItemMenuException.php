<?php

namespace App\Domains\Catalogo\Application\Exceptions\ItemMenu;

use Exception;

class ItemMenuException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
            return 'ITEM_MENU_NOT_FOUND';
    }
}
