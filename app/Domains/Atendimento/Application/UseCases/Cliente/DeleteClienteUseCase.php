<?php

namespace App\Domains\Atendimento\Application\UseCases\Cliente;

use App\Domains\Atendimento\Application\Exceptions\Cliente\ClienteNotFoundException;
use App\Domains\Atendimento\Domain\Repositories\ClienteRepositoryInterface;

class DeleteClienteUseCase
{
    public function __construct(
        protected ClienteRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        $cliente = $this->repository->find($id);

        if (!$cliente) {
            throw new ClienteNotFoundException();
        }

        $this->repository->delete($cliente);
    }
}
