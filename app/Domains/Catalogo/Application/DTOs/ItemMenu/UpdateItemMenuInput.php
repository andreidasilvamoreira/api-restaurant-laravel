<?php

namespace App\Domains\Catalogo\Application\DTOs\ItemMenu;

class UpdateItemMenuInput
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $nome,
        public readonly ?string $descricao,
        public readonly bool $descricaoInformada,
        public readonly ?float $preco,
        public readonly ?string $disponibilidade,
        public readonly ?int $categoriaId,
    ) {}
}
