<?php

namespace App\Domains\Catalogo\Application\UseCases\Categoria;

use App\Domains\Catalogo\Application\DTOs\Categoria\UpdateCategoriaInput;
use App\Domains\Catalogo\Application\Exceptions\Categoria\CategoriaNotFoundException;
use App\Domains\Catalogo\Application\Mappers\CategoriaMapper;
use App\Domains\Catalogo\Domain\Repositories\CategoriaRepositoryInterface;

class UpdateCategoriaUseCase
{
    public function __construct(
        protected CategoriaRepositoryInterface $repository
    ) {}

    public function execute(UpdateCategoriaInput $input)
    {
        $categoria = $this->repository->find($input->id);

        if (!$categoria) {
            throw new CategoriaNotFoundException();
        }

        $data = [];

        if ($input->nome !== null) {
            $data['nome'] = $input->nome;
        }

        if ($input->descricaoInformada) {
            $data['descricao'] = $input->descricao;
        }

        $categoria = $this->repository->update($categoria, $data);

        return CategoriaMapper::toOutput($categoria);
    }
}
