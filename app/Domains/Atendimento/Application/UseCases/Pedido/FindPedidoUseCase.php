<?php

namespace App\Domains\Atendimento\Application\UseCases\Pedido;

use App\Domains\Atendimento\Application\Exceptions\Pedido\PedidoNotFoundException;
use App\Domains\Atendimento\Application\Mappers\PedidoMapper;
use App\Domains\Atendimento\Domain\Repositories\PedidoRepositoryInterface;

class FindPedidoUseCase
{
    public function __construct(
        protected PedidoRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        $pedido = $this->repository->find($id);

        if (!$pedido) {
            throw new PedidoNotFoundException();
        }

        return PedidoMapper::toOutput($pedido);
    }
}
