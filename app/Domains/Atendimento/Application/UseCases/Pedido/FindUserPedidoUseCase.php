<?php

namespace App\Domains\Atendimento\Application\UseCases\Pedido;

use App\Domains\Atendimento\Application\Mappers\PedidoMapper;
use App\Domains\Atendimento\Domain\Repositories\PedidoRepositoryInterface;
use App\Models\User;

class FindUserPedidoUseCase
{
    public function __construct(
        protected PedidoRepositoryInterface $repository
    ) {}

    public function execute(User $user, ?int $restauranteId = null): array
    {
        return array_map(
            fn ($pedido) => PedidoMapper::toOutput($pedido),
            $this->repository->findAll($user, $restauranteId)->all()
        );
    }

    public function executeAsCustomer(User $user): array
    {
        return array_map(
            fn ($pedido) => PedidoMapper::toOutput($pedido),
            $this->repository->findOwnCustomerOrders($user)->all()
        );
    }
}
