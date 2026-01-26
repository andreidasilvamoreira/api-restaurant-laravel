<?php

namespace App\Domains\Atendimento\Controllers;

use App\Domains\Atendimento\Requests\Mesa\StoreMesaRequest;
use App\Domains\Atendimento\Requests\Mesa\UpdateMesaRequest;
use App\Domains\Atendimento\Resources\MesaResource;
use App\Domains\Atendimento\Services\MesaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MesaController extends Controller
{
    protected MesaService $mesaService;
    public function __construct(MesaService $mesaService)
    {
        $this->mesaService = $mesaService;
    }

    public function index(): AnonymousResourceCollection
    {
        return MesaResource::collection($this->mesaService->findAll());
    }

    public function show(int $id): MesaResource
    {
        $mesa = $this->mesaService->find($id);
        return new MesaResource($mesa);
    }

    public function store(StoreMesaRequest $request): MesaResource
    {
        $mesa = $this->mesaService->create($request->validated());
        return new MesaResource($mesa);
    }

    public function update(UpdateMesaRequest $request, int $id): MesaResource
    {
        $mesa = $this->mesaService->update($request->validated(), $id);
        return new MesaResource($mesa);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->mesaService->delete($id);
        return response()->json(["message" => "Mesa deletada com sucesso!"]);
    }
}
