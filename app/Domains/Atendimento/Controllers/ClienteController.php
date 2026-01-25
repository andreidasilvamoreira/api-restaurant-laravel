<?php

namespace App\Domains\Atendimento\Controllers;

use App\Domains\Atendimento\Requests\Cliente\StoreClienteRequest;
use App\Domains\Atendimento\Requests\Cliente\UpdateClienteRequest;
use App\Domains\Atendimento\Resources\ClienteResource;
use App\Domains\Atendimento\Services\ClienteService;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;
    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }
    public function index()
    {
        return ClienteResource::collection($this->clienteService->findAll());
    }
    public function show(int $id)
    {
        $cliente = $this->clienteService->find($id);
        return new ClienteResource($cliente);
    }

    public function store(StoreClienteRequest $request)
    {
        $cliente = $this->clienteService->create($request->validated());
        return new ClienteResource($cliente);
    }

    public function update(UpdateClienteRequest $request, int $id)
    {
        $cliente = $this->clienteService->update($request->validated(), $id);
        response()->json(["message" => "Cliente atualizado com sucesso!"], 200);
        return new ClienteResource($cliente);
    }

    public function destroy(int $id)
    {
        $this->clienteService->delete($id);
        return response()->json(["message" => "Cliente deletado com sucesso!"], 200);
    }
}
