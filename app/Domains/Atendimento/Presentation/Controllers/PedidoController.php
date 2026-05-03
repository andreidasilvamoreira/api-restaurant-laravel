<?php

namespace App\Domains\Atendimento\Presentation\Controllers;

use App\Domains\Atendimento\Application\DTOs\Pedido\CreatePedidoInput;
use App\Domains\Atendimento\Application\DTOs\Pedido\UpdatePedidoInput;
use App\Domains\Atendimento\Application\UseCases\Pedido\CreatePedidoUseCase;
use App\Domains\Atendimento\Application\UseCases\Pedido\DeletePedidoUseCase;
use App\Domains\Atendimento\Application\UseCases\Pedido\FindPedidoUseCase;
use App\Domains\Atendimento\Application\UseCases\Pedido\FindUserPedidoUseCase;
use App\Domains\Atendimento\Application\UseCases\Pedido\UpdatePedidoUseCase;
use App\Domains\Atendimento\Presentation\Requests\Pedido\StorePedidoRequest;
use App\Domains\Atendimento\Presentation\Requests\Pedido\UpdatePedidoRequest;
use App\Domains\Atendimento\Presentation\Resources\PedidoResource;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Restaurante;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PedidoController extends Controller
{
    public function __construct(
        protected FindUserPedidoUseCase $findUserPedidoUseCase,
        protected FindPedidoUseCase $findPedidoUseCase,
        protected CreatePedidoUseCase $createPedidoUseCase,
        protected UpdatePedidoUseCase $updatePedidoUseCase,
        protected DeletePedidoUseCase $deletePedidoUseCase,
    ) {}

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [Pedido::class, $restaurante]);
        $output = $this->findUserPedidoUseCase->execute(auth()->user(), $restaurante->id);
        return PedidoResource::collection($output);
    }

    public function me(): AnonymousResourceCollection
    {
        $output = $this->findUserPedidoUseCase->executeAsCustomer(auth()->user());

        return PedidoResource::collection($output);
    }

    public function show(Pedido $pedido): PedidoResource
    {
        $this->authorize('view', $pedido);
        $output = $this->findPedidoUseCase->execute($pedido->id);
        return new PedidoResource($output);
    }

    public function store(StorePedidoRequest $request, Restaurante $restaurante): JsonResponse
    {
        $this->authorize('createForRestaurant', [Pedido::class, $restaurante]);
        $data = $request->validated();
        $clienteId = auth()->user()->cliente?->id ?? ($data['cliente_id'] ?? null);

        if (!$clienteId) {
            throw new HttpResponseException(response()->json([
                'message' => 'O usuário precisa ter um perfil de cliente para criar pedidos.'
            ], 422));
        }

        $input = new CreatePedidoInput(
            dataHora: $data['data_hora'] ?? now()->toDateTimeString(),
            status: $data['status'] ?? Pedido::STATUS_ABERTO,
            clienteId: $clienteId,
            mesaId: $data['mesa_id'] ?? null,
            restauranteId: $restaurante->id,
            atendenteId: $data['atendente_id'] ?? null,
            itens: $data['itens'],
        );

        $output = $this->createPedidoUseCase->execute($input);

        return (new PedidoResource($output))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePedidoRequest $request, Pedido $pedido): PedidoResource
    {
        $this->authorize('update', $pedido);
        $input = new UpdatePedidoInput(
            id: $pedido->id,
            changes: $request->validated(),
        );

        $output = $this->updatePedidoUseCase->execute($input);

        return new PedidoResource($output);
    }

    public function destroy(Pedido $pedido): JsonResponse
    {
        $this->authorize('delete', $pedido);
        $this->deletePedidoUseCase->execute($pedido->id);
        return response()->json(["message" => "Pedido deletado com sucesso!"]);
    }
}
