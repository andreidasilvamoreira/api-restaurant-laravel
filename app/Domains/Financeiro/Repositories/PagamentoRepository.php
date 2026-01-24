<?php

namespace App\Domains\Financeiro\Repositories;

use App\Models\Pagamento;
use Illuminate\Support\Collection;

class PagamentoRepository
{
    public function findAll(): Collection
    {
        return Pagamento::all();
    }

    public function find($id) : Pagamento
    {
        return Pagamento::find($id);
    }

    public function create(array $data) : Pagamento
    {
        return Pagamento::create($data);
    }

    public function update(Pagamento $pagamento, array $data) : Pagamento
    {
        $pagamento->update($data);
        return  $pagamento;
    }

    public function delete(Pagamento $pagamento) : void
    {
        $pagamento->delete();
    }
}
