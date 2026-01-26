<?php

namespace App\Domains\Atendimento\Controllers;

use App\Domains\Atendimento\Requests\Pedido\StorePedidoRequest;
use App\Domains\Atendimento\Requests\Pedido\UpdatePedidoRequest;
use App\Domains\Atendimento\Resources\PedidoResource;
use App\Domains\Atendimento\Services\PedidoService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PedidoController extends Controller
{
    protected PedidoService $pedidoService;
    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function index(): AnonymousResourceCollection
    {
        return PedidoResource::collection($this->pedidoService->findAll());
    }

    public function show(int $id): PedidoResource
    {
        $pedido = $this->pedidoService->find($id);
        return new PedidoResource($pedido);
    }

    public function store(StorePedidoRequest $request): PedidoResource
    {
        $pedido = $this->pedidoService->create($request->validated());
        return new PedidoResource($pedido);
    }

    public function update(UpdatePedidoRequest $request, int $id): PedidoResource
    {
        $pedido = $this->pedidoService->update($request->validated(), $id);
        return new PedidoResource($pedido);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->pedidoService->delete($id);
        return response()->json(["message" => "Pedido deletado com sucesso!"]);
    }
}
