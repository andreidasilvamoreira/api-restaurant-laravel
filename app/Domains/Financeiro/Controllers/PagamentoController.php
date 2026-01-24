<?php

namespace App\Domains\Financeiro\Controllers;

use App\Domains\Financeiro\Requests\Pagamento\StorePagamentoRequest;
use App\Domains\Financeiro\Requests\Pagamento\UpdatePagamentoRequest;
use App\Domains\Financeiro\Resources\PagamentoResource;
use App\Domains\Financeiro\Services\PagamentoService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PagamentoController extends Controller
{
    protected PagamentoService $pagamentoService;
    public function __construct(PagamentoService $pagamentoService)
    {
        $this->pagamentoService = $pagamentoService;
    }

    public function findAll(): AnonymousResourceCollection
    {
        return PagamentoResource::collection($this->pagamentoService->findAll());
    }

    public function find($id): PagamentoResource
    {
        $pagamento = $this->pagamentoService->find($id);
        return new PagamentoResource($pagamento);
    }

    public function create(StorePagamentoRequest $request) : PagamentoResource
    {
        $pagamento = $this->pagamentoService->create($request->validated());
        return new PagamentoResource($pagamento);
    }

    public function update(UpdatePagamentoRequest $request, int $id): PagamentoResource
    {
        $pagamento = $this->pagamentoService->update($request->validated(), $id);
        return new PagamentoResource($pagamento);
    }

    public function delete(int $id): JsonResponse
    {
        $this->pagamentoService->delete($id);
        return response()->json(['message' => "Pagamento deletado com sucesso!"], 200);
    }
}
