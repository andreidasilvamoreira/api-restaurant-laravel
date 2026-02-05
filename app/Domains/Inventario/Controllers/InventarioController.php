<?php

namespace App\Domains\Inventario\Controllers;

use App\Domains\Inventario\Requests\Inventario\StoreInventarioRequest;
use App\Domains\Inventario\Requests\Inventario\UpdateInventarioRequest;
use App\Domains\Inventario\Resources\InventarioResource;
use App\Domains\Inventario\Services\InventarioService;
use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InventarioController extends Controller
{
    protected InventarioService $inventarioService;
    public function __construct(InventarioService $inventarioService)
    {
        $this->inventarioService = $inventarioService;
    }

    public function index():AnonymousResourceCollection
    {
        $this->authorize('viewAny', Inventario::class);
        return InventarioResource::collection($this->inventarioService->findAll());
    }

    public function show(int $id): InventarioResource
    {
        $this->authorize('view', Inventario::class);
        $inventario = $this->inventarioService->find($id);
        return new InventarioResource($inventario);
    }

    public function store(StoreInventarioRequest $request): InventarioResource
    {
        $this->authorize('create', Inventario::class);
        $inventario = $this->inventarioService->create($request->validated());
        return new InventarioResource($inventario);
    }

    public function update(UpdateInventarioRequest $request, int $id): InventarioResource
    {
        $this->authorize('update', Inventario::class);
        $inventario = $this->inventarioService->update($request->validated(), $id);
        return new InventarioResource($inventario);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->authorize('delete', Inventario::class);
        $this->inventarioService->delete($id);
        return response()->json(['message' => 'Inventário deletado com sucesso!']);
    }
}
