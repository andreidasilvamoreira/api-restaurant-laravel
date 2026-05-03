<?php

namespace App\Domains\Atendimento\Presentation\Controllers;

use App\Domains\Atendimento\Application\DTOs\Cliente\CreateClienteInput;
use App\Domains\Atendimento\Application\DTOs\Cliente\UpdateClienteInput;
use App\Domains\Atendimento\Application\UseCases\Cliente\CreateClienteUseCase;
use App\Domains\Atendimento\Application\UseCases\Cliente\DeleteClienteUseCase;
use App\Domains\Atendimento\Application\UseCases\Cliente\FindAllClientesUseCase;
use App\Domains\Atendimento\Application\UseCases\Cliente\FindClienteUseCase;
use App\Domains\Atendimento\Application\UseCases\Cliente\UpdateClienteUseCase;
use App\Domains\Atendimento\Presentation\Requests\Cliente\StoreClienteRequest;
use App\Domains\Atendimento\Presentation\Requests\Cliente\UpdateClienteRequest;
use App\Domains\Atendimento\Presentation\Resources\ClienteResource;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClienteController extends Controller
{
    public function __construct(
        protected FindAllClientesUseCase $findAllClientesUseCase,
        protected FindClienteUseCase $findClienteUseCase,
        protected CreateClienteUseCase $createClienteUseCase,
        protected UpdateClienteUseCase $updateClienteUseCase,
        protected DeleteClienteUseCase $deleteClienteUseCase,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Cliente::class);
        $output = $this->findAllClientesUseCase->execute();
        return ClienteResource::collection($output);
    }

    public function me(): ClienteResource
    {
        $cliente = auth()->user()->cliente;
        if (!$cliente) {
            abort(404, 'Cliente não encontrado');
        }

        $output = $this->findClienteUseCase->execute($cliente->id);

        return new ClienteResource($output);
    }

    public function store(StoreClienteRequest $request): JsonResponse
    {
        $this->authorize('create', Cliente::class);
        $data = $request->validated();

        $input = new CreateClienteInput(
            telefone: $data['telefone'] ?? null,
            endereco: $data['endereco'] ?? null,
            userId: auth()->id(),
        );

        $output = $this->createClienteUseCase->execute($input);

        return (new ClienteResource($output))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateClienteRequest $request): ClienteResource
    {
        $cliente = auth()->user()->cliente;

        if (!$cliente) {
            abort(404, 'Cliente não encontrado');
        }

        $this->authorize('update', $cliente);
        $input = new UpdateClienteInput(
            id: $cliente->id,
            changes: $request->validated(),
        );

        $output = $this->updateClienteUseCase->execute($input);

        return new ClienteResource($output);
    }

    public function destroy(Cliente $cliente): JsonResponse
    {
        $this->authorize('delete', $cliente);
        $this->deleteClienteUseCase->execute($cliente->id);
        return response()->json(["message" => "Cliente deletado com sucesso!"], 200);
    }
}
