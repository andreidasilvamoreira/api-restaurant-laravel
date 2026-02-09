<?php

namespace App\Domains\Atendimento\Controllers;

use App\Domains\Atendimento\Requests\Cliente\StoreClienteRequest;
use App\Domains\Atendimento\Requests\Cliente\UpdateClienteRequest;
use App\Domains\Atendimento\Resources\ClienteResource;
use App\Domains\Atendimento\Services\ClienteService;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;
    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Cliente::class);
        return ClienteResource::collection($this->clienteService->findAll());
    }
    public function me(Cliente $cliente): ClienteResource
    {
        $cliente = auth()->user()->cliente;
        if (!$cliente) {
            abort(404, 'Cliente não encontrado');
        }
        return new ClienteResource($cliente);
    }

    public function store(StoreClienteRequest $request): ClienteResource
    {
        $this->authorize('create', Cliente::class);
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $cliente = $this->clienteService->create($data);
        return new ClienteResource($cliente);
    }

    public function update(UpdateClienteRequest $request): ClienteResource
    {
        $cliente = auth()->user()->cliente;

        if (!$cliente) {
            abort(404, 'Cliente não encontrado');
        }

        $this->authorize('update', $cliente);
        $cliente = $this->clienteService->update($request->validated(), $cliente->id);
        return new ClienteResource($cliente);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->clienteService->delete($id);
        return response()->json(["message" => "Cliente deletado com sucesso!"], 200);
    }
}
