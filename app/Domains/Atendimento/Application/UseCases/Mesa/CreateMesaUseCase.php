<?php

namespace App\Domains\Atendimento\Application\UseCases\Mesa;

use App\Domains\Atendimento\Application\DTOs\Mesa\CreateMesaInput;
use App\Domains\Atendimento\Application\Mappers\MesaMapper;
use App\Domains\Atendimento\Domain\Repositories\MesaRepositoryInterface;
use App\Models\Mesa;

class CreateMesaUseCase
{
    public function __construct(
        protected MesaRepositoryInterface $repository
    ) {}

    public function execute(CreateMesaInput $input)
    {
        $mesa = $this->repository->create([
            'numero' => $input->numero,
            'capacidade' => $input->capacidade,
            'status' => $input->status ?? Mesa::STATUS_DISPONIVEL,
            'restaurante_id' => $input->restauranteId,
        ]);

        return MesaMapper::toOutput($mesa);
    }
}
