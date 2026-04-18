<?php

namespace App\Domains\Inventory\Presentation\Controllers;

use App\Domains\Inventory\Application\DTOs\Inventario\CreateInventoryInput;
use App\Domains\Inventory\Application\DTOs\Inventario\UpdateInventoryInput;
use App\Domains\Inventory\Application\UseCases\Inventory\CreateInventoryUseCase;
use App\Domains\Inventory\Application\UseCases\Inventory\DeleteInventoryUseCase;
use App\Domains\Inventory\Application\UseCases\Inventory\FindInventoryUseCase;
use App\Domains\Inventory\Application\UseCases\Inventory\FindUserInventoryUseCase;
use App\Domains\Inventory\Application\UseCases\Inventory\UpdateInventoryUseCase;
use App\Domains\Inventory\Presentation\Requests\Inventario\StoreInventarioRequest;
use App\Domains\Inventory\Presentation\Requests\Inventario\UpdateInventarioRequest;
use App\Domains\Inventory\Presentation\Resources\InventarioResource;
use App\Http\Controllers\Controller;
use App\Models\Inventario;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InventarioController extends Controller
{
    public function __construct(
        protected FindUserInventoryUseCase $findUserInventoryUseCase,
        protected FindInventoryUseCase $findInventoryUseCase,
        protected CreateInventoryUseCase $createInventoryUseCase,
        protected UpdateInventoryUseCase $updateInventoryUseCase,
        protected DeleteInventoryUseCase $deleteInventoryUseCase,
    ) {}

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [Inventario::class, $restaurante]);

        $output = $this->findUserInventoryUseCase->execute(auth()->user());

        return InventarioResource::collection($output);
    }

    public function show(Inventario $inventario): InventarioResource
    {
        $this->authorize('view', $inventario);

        $output = $this->findInventoryUseCase->execute($inventario->id);

        return new InventarioResource($output);
    }

    public function store(StoreInventarioRequest $request, Restaurante $restaurante): JsonResponse
    {
        $this->authorize('createForRestaurante', [Inventario::class, $restaurante]);

        $data = $request->validated();
        $input = new CreateInventoryInput(
            name: $data['nome'],
            unit: $data['unidade_medida'],
            currentQuantity: (float) $data['quantidade_atual'],
            costPrice: (float) $data['preco_custo'],
            restaurantId: $restaurante->id,
            supplierId: $data['fornecedor_id'],
        );

        $output = $this->createInventoryUseCase->execute($input);

        return (new InventarioResource($output))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateInventarioRequest $request, Inventario $inventario): InventarioResource
    {
        $this->authorize('update', $inventario);

        $data = $request->validated();
        $input = new UpdateInventoryInput(
            id: $inventario->id,
            name: $data['nome'] ?? null,
            unit: $data['unidade_medida'] ?? null,
            currentQuantity: isset($data['quantidade_atual']) ? (float) $data['quantidade_atual'] : null,
            costPrice: isset($data['preco_custo']) ? (float) $data['preco_custo'] : null,
            restaurantId: $data['restaurante_id'] ?? null,
            supplierId: $data['fornecedor_id'] ?? null,
        );

        $output = $this->updateInventoryUseCase->execute($input);

        return new InventarioResource($output);
    }

    public function destroy(Inventario $inventario): JsonResponse
    {
        $this->authorize('delete', $inventario);

        $this->deleteInventoryUseCase->execute($inventario->id);

        return response()->json(['message' => 'Inventário deletado com sucesso!']);
    }
}
