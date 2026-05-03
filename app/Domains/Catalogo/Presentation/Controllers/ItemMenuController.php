<?php

namespace App\Domains\Catalogo\Presentation\Controllers;

use App\Domains\Catalogo\Application\DTOs\ItemMenu\CreateItemMenuInput;
use App\Domains\Catalogo\Application\DTOs\ItemMenu\UpdateItemMenuInput;
use App\Domains\Catalogo\Application\UseCases\ItemMenu\CreateItemMenuUseCase;
use App\Domains\Catalogo\Application\UseCases\ItemMenu\DeleteItemMenuUseCase;
use App\Domains\Catalogo\Application\UseCases\ItemMenu\FindItemMenuUseCase;
use App\Domains\Catalogo\Application\UseCases\ItemMenu\FindUserItemMenuUseCase;
use App\Domains\Catalogo\Application\UseCases\ItemMenu\UpdateItemMenuUseCase;
use App\Domains\Catalogo\Presentation\Requests\ItemMenu\StoreItemMenuRequest;
use App\Domains\Catalogo\Presentation\Requests\ItemMenu\UpdateItemMenuRequest;
use App\Domains\Catalogo\Presentation\Resources\ItemMenuResource;
use App\Http\Controllers\Controller;
use App\Models\ItemMenu;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemMenuController extends Controller
{
    public function __construct(
        protected FindUserItemMenuUseCase $findUserItemMenuUseCase,
        protected FindItemMenuUseCase $findItemMenuUseCase,
        protected CreateItemMenuUseCase $createItemMenuUseCase,
        protected UpdateItemMenuUseCase $updateItemMenuUseCase,
        protected DeleteItemMenuUseCase $deleteItemMenuUseCase,
    ) {}

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [ItemMenu::class, $restaurante]);

        $output = $this->findUserItemMenuUseCase->execute(auth()->user(), $restaurante->id);

        return ItemMenuResource::collection($output);
    }

    public function show(ItemMenu $itemMenu): JsonResource
    {
        $this->authorize('view', $itemMenu);

        $output = $this->findItemMenuUseCase->execute($itemMenu->id);

        return new ItemMenuResource($output);
    }

    public function store(StoreItemMenuRequest $request, Restaurante $restaurante): JsonResponse
    {
        $this->authorize('createForRestaurante', [ItemMenu::class, $restaurante]);
        $data = $request->validated();

        $input = new CreateItemMenuInput(
            nome: $data['nome'],
            descricao: $data['descricao'] ?? null,
            preco: (float) $data['preco'],
            disponibilidade: $data['disponibilidade'],
            categoriaId: $data['categoria_id'],
        );

        $output = $this->createItemMenuUseCase->execute($input);

        return (new ItemMenuResource($output))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateItemMenuRequest $request, ItemMenu $itemMenu): JsonResource
    {
        $this->authorize('update', $itemMenu);
        $data = $request->validated();

        $input = new UpdateItemMenuInput(
            id: $itemMenu->id,
            nome: $data['nome'] ?? null,
            descricao: $data['descricao'] ?? null,
            descricaoInformada: array_key_exists('descricao', $data),
            preco: isset($data['preco']) ? (float) $data['preco'] : null,
            disponibilidade: $data['disponibilidade'] ?? null,
            categoriaId: $data['categoria_id'] ?? null,
        );

        $output = $this->updateItemMenuUseCase->execute($input);

        return new ItemMenuResource($output);
    }

    public function destroy(ItemMenu $itemMenu): JsonResponse
    {
        $this->authorize('delete', $itemMenu);
        $this->deleteItemMenuUseCase->execute($itemMenu->id);
         return response()->json(["message" => "Item removida com sucesso"]);
    }
}
