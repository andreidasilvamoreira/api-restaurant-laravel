<?php

namespace App\Domains\Atendimento\Application\UseCases\Mesa;

use App\Domains\Atendimento\Application\DTOs\Mesa\UpdateMesaInput;
use App\Domains\Atendimento\Application\Exceptions\Mesa\MesaNotFoundException;
use App\Domains\Atendimento\Application\Mappers\MesaMapper;
use App\Domains\Atendimento\Domain\Repositories\MesaRepositoryInterface;

class UpdateMesaUseCase
{
    public function __construct(
        protected MesaRepositoryInterface $repository
    ) {}

    public function execute(UpdateMesaInput $input)
    {
        $mesa = $this->repository->find($input->id);

        if (!$mesa) {
            throw new MesaNotFoundException();
        }

        $mesa = $this->repository->update($input->changes, $mesa);

        return MesaMapper::toOutput($mesa);
    }
}
