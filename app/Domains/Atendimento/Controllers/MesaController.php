<?php

namespace App\Domains\Atendimento\Controllers;

use App\Domains\Atendimento\Requests\Mesa\StoreMesaRequest;
use App\Domains\Atendimento\Requests\Mesa\UpdateMesaRequest;
use App\Domains\Atendimento\Resources\MesaResource;
use App\Domains\Atendimento\Services\MesaService;
use App\Http\Controllers\Controller;
use App\Models\Mesa;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MesaController extends Controller
{
    protected MesaService $mesaService;
    public function __construct(MesaService $mesaService)
    {
        $this->mesaService = $mesaService;
    }

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [Mesa::class, $restaurante]);
        return MesaResource::collection($this->mesaService->findAll(auth()->user()));
    }

    public function show(Mesa $mesa): MesaResource
    {
        $this->authorize('view', $mesa);
        $mesa = $this->mesaService->find($mesa->id);
        return new MesaResource($mesa);
    }

    public function store(StoreMesaRequest $request, Restaurante $restaurante): MesaResource
    {
        $this->authorize('createForRestaurant', [Mesa::class, $restaurante]);
        $data = $request->validated();
        $data['restaurante_id'] = $restaurante->id;

        $mesa = $this->mesaService->create($data);
        return new MesaResource($mesa);
    }

    public function update(UpdateMesaRequest $request, Mesa $mesa): MesaResource
    {
        $this->authorize('update', $mesa);
        $mesa = $this->mesaService->update($request->validated(), $mesa->id);
        return new MesaResource($mesa);
    }

    public function destroy(Mesa $mesa): JsonResponse
    {
        $this->authorize('delete', $mesa);
        $this->mesaService->delete($mesa->id);
        return response()->json(["message" => "Mesa deletada com sucesso!"]);
    }
}
