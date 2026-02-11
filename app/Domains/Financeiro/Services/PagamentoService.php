<?php

namespace App\Domains\Financeiro\Services;

use App\Domains\Financeiro\Exceptions\Pagamento\PagamentoNotFoundException;
use App\Domains\Financeiro\Repositories\PagamentoRepository;
use App\Models\Pagamento;
use App\Models\User;
use Illuminate\Support\Collection;

class PagamentoService
{
    protected PagamentoRepository $pagamentoRepository;
    public function __construct(PagamentoRepository $pagamentoRepository)
    {
        $this->pagamentoRepository = $pagamentoRepository;
    }

    public function findAll(User $user): Collection
    {
        return $this->pagamentoRepository->findAll($user);
    }

    public function find(int $id): Pagamento
    {
        return $this->findOrFail($id);
    }

    public function create(array $data): Pagamento
    {
        return $this->pagamentoRepository->create($data);
    }

    public function update(array $data, int $id): Pagamento
    {
        $pagamento = $this->findOrFail($id);
        return $this->pagamentoRepository->update($pagamento, $data);
    }

    public function delete(int $id): void
    {
        $pagamento = $this->findOrFail($id);
        $this->pagamentoRepository->delete($pagamento);
    }

    public function findOrFail(int $id) : Pagamento
    {
        $pagamento = $this->pagamentoRepository->find($id);

        if (!$pagamento) {
            throw new PagamentoNotFoundException();
        }

        return $pagamento;
    }
}
