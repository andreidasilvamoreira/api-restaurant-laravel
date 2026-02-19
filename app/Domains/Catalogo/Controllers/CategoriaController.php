<?php

namespace App\Domains\Catalogo\Controllers;

use App\Domains\Catalogo\Requests\Categoria\StoreCategoriaRequest;
use App\Domains\Catalogo\Requests\Categoria\UpdateCategoriaRequest;
use App\Domains\Catalogo\Resources\CategoriaResource;
use App\Domains\Catalogo\Services\CategoriaService;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Restaurante;
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
        $this->authorize('viewAny', Categoria::class);
        return CategoriaResource::collection($this->categoriaService->findAll(auth()->user()));
    }

    public function show(Categoria $categoria): CategoriaResource
    {
        $this->authorize('view', $categoria);
        $categoria = $this->categoriaService->find($categoria->id);
        return new CategoriaResource($categoria);
    }

    public function store(StoreCategoriaRequest $request, Restaurante $restaurante): CategoriaResource
    {
        $this->authorize('createForRestaurante', [Categoria::class, $restaurante]);
        $data = $request->validated();
        $data['restaurante_id'] = $restaurante->id;
        $categoria = $this->categoriaService->create($data);
        return new CategoriaResource($categoria);
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): CategoriaResource
    {
        $this->authorize('update', $categoria);
        $categoria = $this->categoriaService->update($request->validated(), $categoria->id);
        return new CategoriaResource($categoria);
    }

    public function destroy(Categoria $categoria): JsonResponse
    {
        $this->authorize('delete', [Categoria::class, $categoria]);
        $this->categoriaService->delete($categoria->id);
        return response()->json(["message" => "Categoria removida com sucesso"]);
    }
}
