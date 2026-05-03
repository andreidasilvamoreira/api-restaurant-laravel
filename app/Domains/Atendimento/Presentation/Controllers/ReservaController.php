<?php

namespace App\Domains\Atendimento\Presentation\Controllers;

use App\Domains\Atendimento\Application\DTOs\Reserva\CreateReservaInput;
use App\Domains\Atendimento\Application\DTOs\Reserva\UpdateReservaInput;
use App\Domains\Atendimento\Application\UseCases\Reserva\CreateReservaUseCase;
use App\Domains\Atendimento\Application\UseCases\Reserva\DeleteReservaUseCase;
use App\Domains\Atendimento\Application\UseCases\Reserva\FindReservaUseCase;
use App\Domains\Atendimento\Application\UseCases\Reserva\FindUserReservaUseCase;
use App\Domains\Atendimento\Application\UseCases\Reserva\UpdateReservaUseCase;
use App\Domains\Atendimento\Presentation\Requests\Reserva\StoreReservaRequest;
use App\Domains\Atendimento\Presentation\Requests\Reserva\UpdateReservaRequest;
use App\Domains\Atendimento\Presentation\Resources\ReservaResource;
use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservaController extends Controller
{
    public function __construct(
        protected FindUserReservaUseCase $findUserReservaUseCase,
        protected FindReservaUseCase $findReservaUseCase,
        protected CreateReservaUseCase $createReservaUseCase,
        protected UpdateReservaUseCase $updateReservaUseCase,
        protected DeleteReservaUseCase $deleteReservaUseCase,
    ) {}

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [Reserva::class, $restaurante]);
        $output = $this->findUserReservaUseCase->execute(auth()->user(), $restaurante->id);
        return ReservaResource::collection($output);
    }

    public function show(Reserva $reserva): ReservaResource
    {
        $this->authorize('view', $reserva);
        $output = $this->findReservaUseCase->execute($reserva->id);
        return new ReservaResource($output);
    }

    public function store(StoreReservaRequest $request, Restaurante $restaurante): JsonResponse
    {
        $this->authorize('createForRestaurant', [Reserva::class, $restaurante]);
        $data = $request->validated();

        $input = new CreateReservaInput(
            dataReserva: $data['data_reserva'],
            numeroPessoas: $data['numero_pessoas'],
            status: $data['status'],
            mesaId: $data['mesa_id'] ?? null,
            clienteId: $data['cliente_id'],
            restauranteId: $restaurante->id,
        );

        $output = $this->createReservaUseCase->execute($input);

        return (new ReservaResource($output))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateReservaRequest $request, Reserva $reserva): ReservaResource
    {
        $this->authorize('update', $reserva);
        $input = new UpdateReservaInput(
            id: $reserva->id,
            changes: $request->validated(),
        );

        $output = $this->updateReservaUseCase->execute($input);

        return new ReservaResource($output);
    }

    public function destroy(Reserva $reserva): JsonResponse
    {
        $this->authorize('delete', $reserva);
        $this->deleteReservaUseCase->execute($reserva->id);
        return response()->json(["message" => "Reserva removida com sucesso!"], 200);
    }
}
