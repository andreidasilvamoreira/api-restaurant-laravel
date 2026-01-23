<?php

namespace App\Domains\Catalogo\Exceptions\ItemMenu;

class ItemMenuNotFoundException extends ItemMenuException
{
    protected $message = 'ItemMenu não encontrado';

    public function getStatus(): int
    {
        return 404;
    }

    public function getErrorCode(): string
    {
        return 'ITEM_MENU_NOT_FOUND';
    }
}
