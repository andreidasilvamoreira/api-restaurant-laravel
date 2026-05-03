<?php

namespace App\Domains\Atendimento\Application\UseCases\Cliente;

use App\Domains\Atendimento\Application\Mappers\ClienteMapper;
use App\Domains\Atendimento\Domain\Repositories\ClienteRepositoryInterface;

class FindAllClientesUseCase
{
    public function __construct(
        protected ClienteRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return array_map(
            fn ($cliente) => ClienteMapper::toOutput($cliente),
            $this->repository->findAll()->all()
        );
    }
}
