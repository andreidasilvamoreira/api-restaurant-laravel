<?php

namespace App\Domains\Atendimento\Application\UseCases\Pedido;

use App\Domains\Atendimento\Application\DTOs\Pedido\UpdatePedidoInput;
use App\Domains\Atendimento\Application\Exceptions\Pedido\PedidoNotFoundException;
use App\Domains\Atendimento\Application\Mappers\PedidoMapper;
use App\Domains\Atendimento\Domain\Repositories\PedidoRepositoryInterface;

class UpdatePedidoUseCase
{
    public function __construct(
        protected PedidoRepositoryInterface $repository
    ) {}

    public function execute(UpdatePedidoInput $input)
    {
        $pedido = $this->repository->find($input->id);

        if (!$pedido) {
            throw new PedidoNotFoundException();
        }

        $pedido = $this->repository->update($input->changes, $pedido);

        return PedidoMapper::toOutput($pedido);
    }
}
