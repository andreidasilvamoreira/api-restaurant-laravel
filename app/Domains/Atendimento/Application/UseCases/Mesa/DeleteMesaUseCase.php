<?php

namespace App\Domains\Atendimento\Application\UseCases\Mesa;

use App\Domains\Atendimento\Application\Exceptions\Mesa\MesaNotFoundException;
use App\Domains\Atendimento\Domain\Repositories\MesaRepositoryInterface;

class DeleteMesaUseCase
{
    public function __construct(
        protected MesaRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        $mesa = $this->repository->find($id);

        if (!$mesa) {
            throw new MesaNotFoundException();
        }

        $this->repository->delete($mesa);
    }
}
