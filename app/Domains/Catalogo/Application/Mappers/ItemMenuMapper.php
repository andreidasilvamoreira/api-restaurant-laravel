<?php

namespace App\Domains\Catalogo\Application\Mappers;

use App\Domains\Catalogo\Application\DTOs\ItemMenu\ItemMenuOutput;
use App\Models\ItemMenu;

class ItemMenuMapper
{
    public static function toOutput(ItemMenu $itemMenu): ItemMenuOutput
    {
        return new ItemMenuOutput(
            id: $itemMenu->id,
            nome: $itemMenu->nome,
            descricao: $itemMenu->descricao,
            preco: (float) $itemMenu->preco,
            disponibilidade: $itemMenu->disponibilidade,
            categoria_id: $itemMenu->categoria_id,
        );
    }
}
