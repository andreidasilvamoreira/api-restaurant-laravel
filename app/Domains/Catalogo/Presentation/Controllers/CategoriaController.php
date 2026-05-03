<?php

namespace App\Domains\Catalogo\Presentation\Controllers;

use App\Domains\Catalogo\Application\DTOs\Categoria\CreateCategoriaInput;
use App\Domains\Catalogo\Application\DTOs\Categoria\UpdateCategoriaInput;
use App\Domains\Catalogo\Application\UseCases\Categoria\CreateCategoriaUseCase;
use App\Domains\Catalogo\Application\UseCases\Categoria\DeleteCategoriaUseCase;
use App\Domains\Catalogo\Application\UseCases\Categoria\FindCategoriaUseCase;
use App\Domains\Catalogo\Application\UseCases\Categoria\FindUserCategoriaUseCase;
use App\Domains\Catalogo\Application\UseCases\Categoria\UpdateCategoriaUseCase;
use App\Domains\Catalogo\Presentation\Requests\Categoria\StoreCategoriaRequest;
use App\Domains\Catalogo\Presentation\Requests\Categoria\UpdateCategoriaRequest;
use App\Domains\Catalogo\Presentation\Resources\CategoriaResource;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoriaController extends Controller
{
    public function __construct(
        protected FindUserCategoriaUseCase $findUserCategoriaUseCase,
        protected FindCategoriaUseCase $findCategoriaUseCase,
        protected CreateCategoriaUseCase $createCategoriaUseCase,
        protected UpdateCategoriaUseCase $updateCategoriaUseCase,
        protected DeleteCategoriaUseCase $deleteCategoriaUseCase,
    ) {}

    public function index(?Restaurante $restaurante = null): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Categoria::class);

        $output = $this->findUserCategoriaUseCase->execute(auth()->user(), $restaurante?->id);

        return CategoriaResource::collection($output);
    }

    public function show(Categoria $categoria): CategoriaResource
    {
        $this->authorize('view', $categoria);

        $output = $this->findCategoriaUseCase->execute($categoria->id);

        return new CategoriaResource($output);
    }

    public function store(StoreCategoriaRequest $request, Restaurante $restaurante): JsonResponse
    {
        $this->authorize('createForRestaurante', [Categoria::class, $restaurante]);
        $data = $request->validated();

        $input = new CreateCategoriaInput(
            nome: $data['nome'],
            descricao: $data['descricao'] ?? null,
            restauranteId: $restaurante->id,
        );

        $output = $this->createCategoriaUseCase->execute($input);

        return (new CategoriaResource($output))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): CategoriaResource
    {
        $this->authorize('update', $categoria);
        $data = $request->validated();

        $input = new UpdateCategoriaInput(
            id: $categoria->id,
            nome: $data['nome'] ?? null,
            descricao: $data['descricao'] ?? null,
            descricaoInformada: array_key_exists('descricao', $data),
        );

        $output = $this->updateCategoriaUseCase->execute($input);

        return new CategoriaResource($output);
    }

    public function destroy(Categoria $categoria): JsonResponse
    {
        $this->authorize('delete', $categoria);
        $this->deleteCategoriaUseCase->execute($categoria->id);
        return response()->json(["message" => "Categoria removida com sucesso"]);
    }
}
