<?php

namespace App\Domains\Atendimento\Presentation\Controllers;

use App\Domains\Atendimento\Application\DTOs\Mesa\CreateMesaInput;
use App\Domains\Atendimento\Application\DTOs\Mesa\UpdateMesaInput;
use App\Domains\Atendimento\Application\UseCases\Mesa\CreateMesaUseCase;
use App\Domains\Atendimento\Application\UseCases\Mesa\DeleteMesaUseCase;
use App\Domains\Atendimento\Application\UseCases\Mesa\FindMesaUseCase;
use App\Domains\Atendimento\Application\UseCases\Mesa\FindUserMesaUseCase;
use App\Domains\Atendimento\Application\UseCases\Mesa\UpdateMesaUseCase;
use App\Domains\Atendimento\Presentation\Requests\Mesa\StoreMesaRequest;
use App\Domains\Atendimento\Presentation\Requests\Mesa\UpdateMesaRequest;
use App\Domains\Atendimento\Presentation\Resources\MesaResource;
use App\Http\Controllers\Controller;
use App\Models\Mesa;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MesaController extends Controller
{
    public function __construct(
        protected FindUserMesaUseCase $findUserMesaUseCase,
        protected FindMesaUseCase $findMesaUseCase,
        protected CreateMesaUseCase $createMesaUseCase,
        protected UpdateMesaUseCase $updateMesaUseCase,
        protected DeleteMesaUseCase $deleteMesaUseCase,
    ) {}

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [Mesa::class, $restaurante]);
        $output = $this->findUserMesaUseCase->execute(auth()->user(), $restaurante->id);
        return MesaResource::collection($output);
    }

    public function show(Mesa $mesa): MesaResource
    {
        $this->authorize('view', $mesa);
        $output = $this->findMesaUseCase->execute($mesa->id);
        return new MesaResource($output);
    }

    public function store(StoreMesaRequest $request, Restaurante $restaurante): MesaResource
    {
        $this->authorize('createForRestaurant', [Mesa::class, $restaurante]);
        $data = $request->validated();

        $input = new CreateMesaInput(
            numero: $data['numero'],
            capacidade: $data['capacidade'],
            status: $data['status'] ?? null,
            restauranteId: $restaurante->id,
        );

        $output = $this->createMesaUseCase->execute($input);

        return new MesaResource($output);
    }

    public function update(UpdateMesaRequest $request, Mesa $mesa): MesaResource
    {
        $this->authorize('update', $mesa);
        $input = new UpdateMesaInput(
            id: $mesa->id,
            changes: $request->validated(),
        );

        $output = $this->updateMesaUseCase->execute($input);

        return new MesaResource($output);
    }

    public function destroy(Mesa $mesa): JsonResponse
    {
        $this->authorize('delete', $mesa);
        $this->deleteMesaUseCase->execute($mesa->id);
        return response()->json(["message" => "Mesa deletada com sucesso!"]);
    }
}
