<?php

namespace App\Domains\Atendimento\Controllers;

use App\Domains\Atendimento\Requests\Reserva\StoreReservaRequest;
use App\Domains\Atendimento\Requests\Reserva\UpdateReservaRequest;
use App\Domains\Atendimento\Resources\ReservaResource;
use App\Domains\Atendimento\Services\ReservaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservaController extends Controller
{
    protected ReservaService $reservaService;
    public function __construct(ReservaService $reservaService)
    {
        $this->reservaService = $reservaService;
    }

    public function index(): AnonymousResourceCollection
    {
        return ReservaResource::collection($this->reservaService->findAll());
    }

    public function show(int $id): ReservaResource
    {
        $reserva = $this->reservaService->find($id);
        return new ReservaResource($reserva);
    }

    public function store(StoreReservaRequest $request): ReservaResource
    {
        $reserva = $this->reservaService->create($request->validated());
        return new ReservaResource($reserva);
    }

    public function update(UpdateReservaRequest $request, int $id): ReservaResource
    {
        $reserva = $this->reservaService->update($request->validated(), $id);
        return new ReservaResource($reserva);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->reservaService->delete($id);
        return response()->json(["message" => "Reserva removida com sucesso!"], 200);
    }
}
