<?php

namespace App\Domains\Atendimento\Application\UseCases\Cliente;

use App\Domains\Atendimento\Application\Exceptions\Cliente\ClienteNotFoundException;
use App\Domains\Atendimento\Application\Mappers\ClienteMapper;
use App\Domains\Atendimento\Domain\Repositories\ClienteRepositoryInterface;

class FindClienteUseCase
{
    public function __construct(
        protected ClienteRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        $cliente = $this->repository->find($id);

        if (!$cliente) {
            throw new ClienteNotFoundException();
        }

        return ClienteMapper::toOutput($cliente);
    }
}
