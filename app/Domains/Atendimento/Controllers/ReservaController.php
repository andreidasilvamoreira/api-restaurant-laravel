<?php

namespace App\Domains\Atendimento\Controllers;

use App\Domains\Atendimento\Requests\Reserva\StoreReservaRequest;
use App\Domains\Atendimento\Requests\Reserva\UpdateReservaRequest;
use App\Domains\Atendimento\Resources\ReservaResource;
use App\Domains\Atendimento\Services\ReservaService;
use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservaController extends Controller
{
    protected ReservaService $reservaService;
    public function __construct(ReservaService $reservaService)
    {
        $this->reservaService = $reservaService;
    }

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [Reserva::class, $restaurante]);
        return ReservaResource::collection($this->reservaService->findAll(auth()->user()));
    }

    public function show(Reserva $reserva): ReservaResource
    {
        $this->authorize('view', $reserva);
        $reserva = $this->reservaService->find($reserva->id);
        return new ReservaResource($reserva);
    }

    public function store(StoreReservaRequest $request, Restaurante $restaurante): ReservaResource
    {
        $this->authorize('createForRestaurant', [Reserva::class, $restaurante]);
        $data = $request->validated();
        $data['restaurante_id'] = $restaurante->id;
        $reserva = $this->reservaService->create($data);
        return new ReservaResource($reserva);
    }

    public function update(UpdateReservaRequest $request, Reserva $reserva): ReservaResource
    {
        $this->authorize('update', $reserva);
        $reserva = $this->reservaService->update($request->validated(), $reserva->id);
        return new ReservaResource($reserva);
    }

    public function destroy(Reserva $reserva): JsonResponse
    {
        $this->authorize('delete', $reserva);
        $this->reservaService->delete($reserva->id);
        return response()->json(["message" => "Reserva removida com sucesso!"], 200);
    }
}
