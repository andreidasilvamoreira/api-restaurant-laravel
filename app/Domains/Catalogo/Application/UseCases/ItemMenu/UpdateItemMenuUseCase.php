<?php

namespace App\Domains\Catalogo\Application\UseCases\ItemMenu;

use App\Domains\Catalogo\Application\DTOs\ItemMenu\UpdateItemMenuInput;
use App\Domains\Catalogo\Application\Exceptions\ItemMenu\ItemMenuNotFoundException;
use App\Domains\Catalogo\Application\Mappers\ItemMenuMapper;
use App\Domains\Catalogo\Domain\Repositories\ItemMenuRepositoryInterface;

class UpdateItemMenuUseCase
{
    public function __construct(
        protected ItemMenuRepositoryInterface $repository
    ) {}

    public function execute(UpdateItemMenuInput $input)
    {
        $itemMenu = $this->repository->find($input->id);

        if (!$itemMenu) {
            throw new ItemMenuNotFoundException();
        }

        $data = [];

        if ($input->nome !== null) {
            $data['nome'] = $input->nome;
        }

        if ($input->descricaoInformada) {
            $data['descricao'] = $input->descricao;
        }

        if ($input->preco !== null) {
            $data['preco'] = $input->preco;
        }

        if ($input->disponibilidade !== null) {
            $data['disponibilidade'] = $input->disponibilidade;
        }

        if ($input->categoriaId !== null) {
            $data['categoria_id'] = $input->categoriaId;
        }

        $itemMenu = $this->repository->update($itemMenu, $data);

        return ItemMenuMapper::toOutput($itemMenu);
    }
}
