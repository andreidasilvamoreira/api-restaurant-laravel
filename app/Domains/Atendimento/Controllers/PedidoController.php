<?php

namespace App\Domains\Atendimento\Controllers;

use App\Domains\Atendimento\Requests\Pedido\StorePedidoRequest;
use App\Domains\Atendimento\Requests\Pedido\UpdatePedidoRequest;
use App\Domains\Atendimento\Resources\PedidoResource;
use App\Domains\Atendimento\Services\PedidoService;
use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Restaurante;
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
        $this->authorize('viewAny', Pedido::class);
        return PedidoResource::collection($this->pedidoService->findAll(auth()->user()));
    }

    public function show(Pedido $pedido): PedidoResource
    {
        $this->authorize('view', $pedido);
        $pedido = $this->pedidoService->find($pedido->id);
        return new PedidoResource($pedido);
    }

    public function store(StorePedidoRequest $request, Restaurante $restaurante): PedidoResource
    {
        $this->authorize('createForRestaurant', [Pedido::class, $restaurante]);
        $data = $request->validated();
        $data['restaurante_id'] = $restaurante->id;
        $pedido = $this->pedidoService->create($data);
        return new PedidoResource($pedido);
    }

    public function update(UpdatePedidoRequest $request, Pedido $pedido): PedidoResource
    {
        $this->authorize('update', $pedido);
        $pedido = $this->pedidoService->update($request->validated(), $pedido->id);
        return new PedidoResource($pedido);
    }

    public function destroy(Pedido $pedido): JsonResponse
    {
        $this->authorize('delete', $pedido);
        $this->pedidoService->delete($pedido->id);
        return response()->json(["message" => "Pedido deletado com sucesso!"]);
    }
}
