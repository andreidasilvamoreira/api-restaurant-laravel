<?php

namespace App\Domains\Inventario\Application\Services;

use App\Domains\Inventario\Application\Exceptions\Fornecedor\FornecedorNotFoundException;
use App\Domains\Inventario\Infrastructure\Persistence\Eloquent\Repositories\FornecedorRepository;
use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Support\Collection;

class FornecedorService
{
    protected FornecedorRepository $fornecedorRepository;
    public function __construct(FornecedorRepository $fornecedorRepository)
    {
        $this->fornecedorRepository = $fornecedorRepository;
    }

    public function findAll(User $user): Collection
    {
        return $this->fornecedorRepository->findAll($user);
    }

    public function find(int $id): ?Fornecedor
    {
        return $this->findOrFail($id);
    }

    public function create(array $data): Fornecedor
    {
         return $this->fornecedorRepository->create($data);
    }

    public function update(int $id, array $data): Fornecedor
    {
        $fornecedor = $this->findOrFail($id);
        return $this->fornecedorRepository->update($data, $fornecedor);
    }

    public function delete(int $id): void
    {
        $fornecedor = $this->findOrFail($id);
        $this->fornecedorRepository->delete($fornecedor);
    }

    public function findOrFail(int $id): Fornecedor
    {
        $fornecedor = $this->fornecedorRepository->find($id);
        if (! $fornecedor) {
            throw new FornecedorNotFoundException();
        }

        return $fornecedor;
    }
}
