<?php

namespace App\Domains\Atendimento\Application\UseCases\Cliente;

use App\Domains\Atendimento\Application\DTOs\Cliente\UpdateClienteInput;
use App\Domains\Atendimento\Application\Exceptions\Cliente\ClienteNotFoundException;
use App\Domains\Atendimento\Application\Mappers\ClienteMapper;
use App\Domains\Atendimento\Domain\Repositories\ClienteRepositoryInterface;

class UpdateClienteUseCase
{
    public function __construct(
        protected ClienteRepositoryInterface $repository
    ) {}

    public function execute(UpdateClienteInput $input)
    {
        $cliente = $this->repository->find($input->id);

        if (!$cliente) {
            throw new ClienteNotFoundException();
        }

        $cliente = $this->repository->update($cliente, $input->changes);

        return ClienteMapper::toOutput($cliente);
    }
}
