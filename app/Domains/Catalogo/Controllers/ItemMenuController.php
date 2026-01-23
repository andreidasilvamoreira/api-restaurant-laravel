<?php

namespace App\Domains\Catalogo\Controllers;

use App\Domains\Catalogo\Requests\ItemMenu\StoreItemMenuRequest;
use App\Domains\Catalogo\Requests\ItemMenu\UpdateItemMenuRequest;
use App\Domains\Catalogo\Resources\ItemMenuResource;
use App\Domains\Catalogo\Services\ItemMenuService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemMenuController extends Controller
{
    protected ItemMenuService $itemMenuService;
    public function __construct(ItemMenuService $itemMenuService)
    {
        $this->itemMenuService = $itemMenuService;
    }

    public function findAll(): JsonResource
    {
        return ItemMenuResource::collection($this->itemMenuService->findAll());
    }

    public function find(int $id): JsonResource
    {
        return new ItemMenuResource($this->itemMenuService->find($id));
    }

    public function create(StoreItemMenuRequest $request): JsonResource
    {
        return new ItemMenuResource($this->itemMenuService->create($request->validated()));
    }

    public function update(UpdateItemMenuRequest $request, int $id): JsonResource
    {
        response()->json(["message" => "Item atualizado com sucesso!"], 200);
        return new ItemMenuResource($this->itemMenuService->update($request->validated(), $id));
    }

    public function delete(int $id)
    {
         $this->itemMenuService->delete($id);
        return response()->json(["message" => "Item removida com sucesso"]);
    }
}
