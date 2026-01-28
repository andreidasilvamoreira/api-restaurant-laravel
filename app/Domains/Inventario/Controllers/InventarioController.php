<?php

namespace App\Domains\Inventario\Controllers;

use App\Domains\Inventario\Requests\Inventario\StoreInventarioRequest;
use App\Domains\Inventario\Requests\Inventario\UpdateInventarioRequest;
use App\Domains\Inventario\Resources\InventarioResource;
use App\Domains\Inventario\Services\InventarioService;
use App\Http\Controllers\Controller;
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
        return InventarioResource::collection($this->inventarioService->findAll());
    }

    public function show(int $id): InventarioResource
    {
        $inventario = $this->inventarioService->find($id);
        return new InventarioResource($inventario);
    }

    public function create(StoreInventarioRequest $request): InventarioResource
    {
        $inventario = $this->inventarioService->create($request->validated());
        return new InventarioResource($inventario);
    }

    public function update(UpdateInventarioRequest $request, int $id): InventarioResource
    {
        $inventario = $this->inventarioService->update($request->validated(), $id);
        return new InventarioResource($inventario);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->inventarioService->delete($id);
        return response()->json(['message' => 'Inventário deletado com sucesso!']);
    }
}
