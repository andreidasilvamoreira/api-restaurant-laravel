<?php

namespace App\Domains\Atendimento\Application\UseCases\Pedido;

use App\Domains\Atendimento\Application\Exceptions\Pedido\PedidoNotFoundException;
use App\Domains\Atendimento\Domain\Repositories\PedidoRepositoryInterface;

class DeletePedidoUseCase
{
    public function __construct(
        protected PedidoRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        $pedido = $this->repository->find($id);

        if (!$pedido) {
            throw new PedidoNotFoundException();
        }

        $this->repository->delete($pedido);
    }
}
