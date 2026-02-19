<?php

namespace App\Domains\Catalogo\Controllers;

use App\Domains\Catalogo\Requests\ItemMenu\StoreItemMenuRequest;
use App\Domains\Catalogo\Requests\ItemMenu\UpdateItemMenuRequest;
use App\Domains\Catalogo\Resources\ItemMenuResource;
use App\Domains\Catalogo\Services\ItemMenuService;
use App\Http\Controllers\Controller;
use App\Models\ItemMenu;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemMenuController extends Controller
{
    protected ItemMenuService $itemMenuService;
    public function __construct(ItemMenuService $itemMenuService)
    {
        $this->itemMenuService = $itemMenuService;
    }

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [ItemMenu::class, $restaurante]);
        return ItemMenuResource::collection($this->itemMenuService->findAll(auth()->user()));
    }

    public function show(ItemMenu $itemMenu): JsonResource
    {
        $this->authorize('view', $itemMenu);
        $itemMenu = $this->itemMenuService->find($itemMenu->id);
        return new ItemMenuResource($itemMenu);
    }

    public function store(StoreItemMenuRequest $request, Restaurante $restaurante): JsonResource
    {
        $this->authorize('createForRestaurante', [ItemMenu::class, $restaurante]);
        $data = $request->validated();
        $data['restaurante_id'] = $restaurante->id;
        $ItemMenu = $this->itemMenuService->create($data);
        return new ItemMenuResource($ItemMenu);
    }

    public function update(UpdateItemMenuRequest $request, ItemMenu $itemMenu): JsonResource
    {
        $this->authorize('update', $itemMenu);
        $itemMenu = $this->itemMenuService->update($request->validated(), $itemMenu->id);
        return new ItemMenuResource($itemMenu);
    }

    public function destroy(ItemMenu $itemMenu): JsonResponse
    {
        $this->authorize('delete', $itemMenu);
        $this->itemMenuService->delete($itemMenu->id);
         return response()->json(["message" => "Item removida com sucesso"]);
    }
}
