<?php

namespace App\Domains\Catalogo\Controllers;

use App\Domains\Catalogo\Requests\Categoria\StoreCategoriaRequest;
use App\Domains\Catalogo\Requests\Categoria\UpdateCategoriaRequest;
use App\Domains\Catalogo\Resources\CategoriaResource;
use App\Domains\Catalogo\Services\CategoriaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoriaController extends Controller
{
    protected CategoriaService $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService= $categoriaService;
    }
    public function index(): AnonymousResourceCollection
    {
        $categoria = $this->categoriaService->findAll();
        return CategoriaResource::collection($categoria);
    }

    public function show(int $id): CategoriaResource
    {
        $categoria = $this->categoriaService->find($id);
        return new CategoriaResource($categoria);
    }

    public function store(StoreCategoriaRequest $request): CategoriaResource
    {
        $categoria = $this->categoriaService->create($request->validated());
        return new CategoriaResource($categoria);
    }

    public function update(UpdateCategoriaRequest $request, int $id): CategoriaResource
    {
        $categoria = $this->categoriaService->update($request->validated(), $id);
        return new CategoriaResource($categoria);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->categoriaService->delete($id);
        return response()->json(["message" => "Categoria removida com sucesso"]);
    }
}
