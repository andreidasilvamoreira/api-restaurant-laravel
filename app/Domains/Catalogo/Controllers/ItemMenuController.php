<?php

namespace App\Domains\Catalogo\Controllers;

use App\Domains\Catalogo\Requests\ItemMenu\StoreItemMenuRequest;
use App\Domains\Catalogo\Requests\ItemMenu\UpdateItemMenuRequest;
use App\Domains\Catalogo\Resources\ItemMenuResource;
use App\Domains\Catalogo\Services\ItemMenuService;
use App\Http\Controllers\Controller;
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

    public function index(): AnonymousResourceCollection
    {
        return ItemMenuResource::collection($this->itemMenuService->findAll());
    }

    public function show(int $id): JsonResource
    {
        $itemMenu = $this->itemMenuService->find($id);
        return new ItemMenuResource($itemMenu);
    }

    public function store(StoreItemMenuRequest $request): JsonResource
    {
        $ItemMenu = $this->itemMenuService->create($request->validated());
        return new ItemMenuResource($ItemMenu);
    }

    public function update(UpdateItemMenuRequest $request, int $id): JsonResource
    {
        $itemMenu = $this->itemMenuService->update($request->validated(), $id);
        return new ItemMenuResource($itemMenu);
    }

    public function destroy(int $id): JsonResponse
    {
         $this->itemMenuService->delete($id);
         return response()->json(["message" => "Item removida com sucesso"]);
    }
}
