<?php

namespace App\Domains\Atendimento\Application\UseCases\Cliente;

use App\Domains\Atendimento\Application\DTOs\Cliente\CreateClienteInput;
use App\Domains\Atendimento\Application\Mappers\ClienteMapper;
use App\Domains\Atendimento\Domain\Repositories\ClienteRepositoryInterface;

class CreateClienteUseCase
{
    public function __construct(
        protected ClienteRepositoryInterface $repository
    ) {}

    public function execute(CreateClienteInput $input)
    {
        $cliente = $this->repository->create([
            'telefone' => $input->telefone,
            'endereco' => $input->endereco,
            'user_id' => $input->userId,
        ]);

        return ClienteMapper::toOutput($cliente);
    }
}
