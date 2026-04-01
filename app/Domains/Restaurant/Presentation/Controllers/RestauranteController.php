<?php

namespace App\Domains\Restaurant\Presentation\Controllers;

use App\Domains\Restaurant\Application\DTOs\Restaurante\CreateRestauranteInput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\UpdateRestauranteInput;
use App\Domains\Restaurant\Application\Services\RestauranteService;
use App\Domains\Restaurant\Presentation\Requests\Restaurante\StoreRestauranteRequest;
use App\Domains\Restaurant\Presentation\Requests\Restaurante\UpdateRestauranteRequest;
use App\Domains\Restaurant\Presentation\Resources\RestauranteResource;
use App\Http\Controllers\Controller;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RestauranteController extends Controller
{
    protected RestauranteService $restauranteService;
    public function __construct(RestauranteService $restauranteService)
    {
        $this->restauranteService = $restauranteService;
    }

    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Restaurante::class);
        return RestauranteResource::collection($this->restauranteService->findAll(auth()->user()));
    }

    public function show(int $id): RestauranteResource
    {
        $model = Restaurante::query()->findOrFail($id);
        $this->authorize('view', $model);

        $restaurante = $this->restauranteService->find($id);
        return new RestauranteResource($restaurante);
    }

    public function store(StoreRestauranteRequest $request): RestauranteResource
    {
        $this->authorize('create', Restaurante::class);
        $data = $request->validated();

        $dto = new CreateRestauranteInput(
            name: $data['nome'],
            description: $data['descricao'] ?? null,
            active: $data['ativo'] ?? false
        );

        $restaurante = $this->restauranteService->create($dto);
        return new RestauranteResource($restaurante);
    }

    public function update(UpdateRestauranteRequest $request, $id) : RestauranteResource
    {
        $model = Restaurante::query()->findOrFail($id);
        $this->authorize('update', $model);

        $data = $request->validated();
        $dto = new UpdateRestauranteInput(
            name: $data['nome'],
            description: $data['descricao'] ?? null,
            active: $data['ativo'] ?? false
        );

        $restauranteAtualizado = $this->restauranteService->update($id, $dto);
        return new RestauranteResource($restauranteAtualizado);
    }

    public function destroy(int $id) : JsonResponse
    {
        $model = Restaurante::query()->findOrFail($id);
        $this->authorize('delete', $model);

        $this->restauranteService->delete($id);
        return response()->json(['message' => 'Restaurant excluido com sucesso!']);
    }
}
