<?php

namespace App\Domains\Inventario\Presentation\Controllers;

use App\Domains\Inventario\Application\Services\InventarioService;
use App\Domains\Inventario\Presentation\Requests\Inventario\StoreInventarioRequest;
use App\Domains\Inventario\Presentation\Requests\Inventario\UpdateInventarioRequest;
use App\Domains\Inventario\Presentation\Resources\InventarioResource;
use App\Http\Controllers\Controller;
use App\Models\Inventario;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InventarioController extends Controller
{
    protected InventarioService $inventarioService;
    public function __construct(InventarioService $inventarioService)
    {
        $this->inventarioService = $inventarioService;
    }

    public function index(Restaurante $restaurante):AnonymousResourceCollection
    {
        $this->authorize('viewAny', [Inventario::class, $restaurante]);
        return InventarioResource::collection($this->inventarioService->findAll(auth()->user()));
    }

    public function show(int $id): InventarioResource
    {
        $inventario = $this->inventarioService->find($id);
        $this->authorize('view', $inventario);
        return new InventarioResource($inventario);
    }

    public function store(StoreInventarioRequest $request, Restaurante $restaurante): InventarioResource
    {

        $this->authorize('createForRestaurante', [Inventario::class, $restaurante]);

        $data = $request->validated();
        $data['restaurante_id'] = $restaurante->id;

        $inventario = $this->inventarioService->create($data);

        return new InventarioResource($inventario);
    }

    public function update(UpdateInventarioRequest $request, int $id): InventarioResource
    {
        $inventario = $this->inventarioService->find($id);
        $this->authorize('update', $inventario);
        $inventario = $this->inventarioService->update($request->validated(), $id);
        return new InventarioResource($inventario);
    }

    public function destroy(int $id): JsonResponse
    {
        $inventario = $this->inventarioService->find($id);
        $this->authorize('delete', $inventario);
        $this->inventarioService->delete($id);
        return response()->json(['message' => 'Inventário deletado com sucesso!']);
    }
}
