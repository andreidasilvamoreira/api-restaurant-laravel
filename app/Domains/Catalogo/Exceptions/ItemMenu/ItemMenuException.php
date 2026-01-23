<?php

namespace App\Domains\Catalogo\Exceptions\ItemMenu;

use mysql_xdevapi\Exception;

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
