<?php

namespace App\Domains\Catalogo\Application\UseCases\ItemMenu;

use App\Domains\Catalogo\Application\DTOs\ItemMenu\CreateItemMenuInput;
use App\Domains\Catalogo\Application\Mappers\ItemMenuMapper;
use App\Domains\Catalogo\Domain\Repositories\ItemMenuRepositoryInterface;

class CreateItemMenuUseCase
{
    public function __construct(
        protected ItemMenuRepositoryInterface $repository
    ) {}

    public function execute(CreateItemMenuInput $input)
    {
        $itemMenu = $this->repository->create([
            'nome' => $input->nome,
            'descricao' => $input->descricao,
            'preco' => $input->preco,
            'disponibilidade' => $input->disponibilidade,
            'categoria_id' => $input->categoriaId,
        ]);

        return ItemMenuMapper::toOutput($itemMenu);
    }
}
