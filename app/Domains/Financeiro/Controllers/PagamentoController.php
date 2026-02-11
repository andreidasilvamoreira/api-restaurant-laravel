<?php

namespace App\Domains\Financeiro\Controllers;

use App\Domains\Financeiro\Requests\Pagamento\StorePagamentoRequest;
use App\Domains\Financeiro\Requests\Pagamento\UpdatePagamentoRequest;
use App\Domains\Financeiro\Resources\PagamentoResource;
use App\Domains\Financeiro\Services\PagamentoService;
use App\Http\Controllers\Controller;
use App\Models\Pagamento;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PagamentoController extends Controller
{
    protected PagamentoService $pagamentoService;
    public function __construct(PagamentoService $pagamentoService)
    {
        $this->pagamentoService = $pagamentoService;
    }

    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Pagamento::class);
        return PagamentoResource::collection($this->pagamentoService->findAll(auth()->user()));
    }

    public function show(Pagamento $pagamento): PagamentoResource
    {
        $this->authorize('view', $pagamento);
        $pagamento = $this->pagamentoService->find($pagamento->id);
        return new PagamentoResource($pagamento);
    }

    public function store(StorePagamentoRequest $request, Restaurante $restaurante) : PagamentoResource
    {
        $this->authorize('createForRestaurant', [Pagamento::class, $restaurante]);
        $data = $request->validated();
        $data['restaurante_id'] = $restaurante->id;
        $pagamento = $this->pagamentoService->create($data);
        return new PagamentoResource($pagamento);
    }

    public function update(UpdatePagamentoRequest $request, Pagamento $pagamento): PagamentoResource
    {
        $this->authorize('update', $pagamento);
        $pagamento = $this->pagamentoService->update($request->validated(), $pagamento->id);
        return new PagamentoResource($pagamento);
    }

    public function destroy(Pagamento $pagamento): JsonResponse
    {
        $this->authorize('delete', $pagamento);
        $this->pagamentoService->delete($pagamento->id);
        return response()->json(['message' => "Pagamento deletado com sucesso!"], 200);
    }
}
