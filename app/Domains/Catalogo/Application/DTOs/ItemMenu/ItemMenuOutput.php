<?php

namespace App\Domains\Catalogo\Application\DTOs\ItemMenu;

class ItemMenuOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $nome,
        public readonly ?string $descricao,
        public readonly float $preco,
        public readonly string $disponibilidade,
        public readonly int $categoria_id,
    ) {}
}
