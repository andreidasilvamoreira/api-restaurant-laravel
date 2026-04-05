<?php

namespace App\Domains\Restaurant\Presentation\Controllers;

use App\Domains\Restaurant\Application\DTOs\Restaurante\CreateRestauranteInput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\UpdateRestauranteInput;
use App\Domains\Restaurant\Application\UseCases\Restaurante\CreateRestauranteUseCase;
use App\Domains\Restaurant\Application\UseCases\Restaurante\DeleteRestauranteUseCase;
use App\Domains\Restaurant\Application\UseCases\Restaurante\FindRestauranteUseCase;
use App\Domains\Restaurant\Application\UseCases\Restaurante\FindUserRestauranteUseCase;
use App\Domains\Restaurant\Application\UseCases\Restaurante\UpdateRestauranteUseCase;
use App\Domains\Restaurant\Presentation\Requests\Restaurante\StoreRestauranteRequest;
use App\Domains\Restaurant\Presentation\Requests\Restaurante\UpdateRestauranteRequest;
use App\Domains\Restaurant\Presentation\Resources\RestauranteResource;
use App\Http\Controllers\Controller;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RestauranteController extends Controller
{
    public function __construct(
        protected FindUserRestauranteUseCase $findUserRestauranteUseCase,
        protected FindRestauranteUseCase $findRestauranteUseCase,
        protected CreateRestauranteUseCase $createRestauranteUseCase,
        protected UpdateRestauranteUseCase $updateRestauranteUseCase,
        protected DeleteRestauranteUseCase $deleteRestauranteUseCase,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Restaurante::class);
        $output = $this->findUserRestauranteUseCase->execute(auth()->user());

        return RestauranteResource::collection($output);
    }

    public function show(int $id): RestauranteResource
    {
        $model = Restaurante::query()->findOrFail($id);
        $this->authorize('view', $model);

        $output = $this->findRestauranteUseCase->execute($id);
        return new RestauranteResource($output);
    }

    public function store(StoreRestauranteRequest $request): RestauranteResource
    {
        $this->authorize('create', Restaurante::class);
        $data = $request->validated();

        $input = new CreateRestauranteInput(
            name: $data['nome'],
            description: $data['descricao'] ?? null,
            active: $data['ativo'] ?? null
        );

        $output = $this->createRestauranteUseCase->execute($input);
        return new RestauranteResource($output);
    }

    public function update(UpdateRestauranteRequest $request, int $id) : RestauranteResource
    {
        $model = Restaurante::query()->findOrFail($id);
        $this->authorize('update', $model);

        $data = $request->validated();

        $input = new UpdateRestauranteInput(
            id: $id,
            name: $data['nome'],
            description: $data['descricao'] ?? null,
            active: $data['ativo'] ?? null
        );

        $output = $this->updateRestauranteUseCase->execute($input);

        return new RestauranteResource($output);
    }

    public function destroy(int $id) : JsonResponse
    {
        $model = Restaurante::query()->findOrFail($id);
        $this->authorize('delete', $model);

        $this->deleteRestauranteUseCase->execute($id);
        return response()->json([
            'message' => 'Restaurant excluido com sucesso!'
        ]);
    }
}
