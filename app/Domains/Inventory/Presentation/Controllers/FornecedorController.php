<?php

namespace App\Domains\Inventory\Presentation\Controllers;

use App\Domains\Inventory\Application\DTOs\Fornecedor\CreateSupplierInput;
use App\Domains\Inventory\Application\DTOs\Fornecedor\UpdateSupplierInput;
use App\Domains\Inventory\Application\UseCases\Supplier\CreateSupplierUseCase;
use App\Domains\Inventory\Application\UseCases\Supplier\DeleteSupplierUseCase;
use App\Domains\Inventory\Application\UseCases\Supplier\FindSupplierUseCase;
use App\Domains\Inventory\Application\UseCases\Supplier\FindUserSupplierUseCase;
use App\Domains\Inventory\Application\UseCases\Supplier\UpdateSupplierUseCase;
use App\Domains\Inventory\Presentation\Requests\Fornecedor\StoreFornecedorRequest;
use App\Domains\Inventory\Presentation\Requests\Fornecedor\UpdateFornecedorRequest;
use App\Domains\Inventory\Presentation\Resources\FornecedorResource;
use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FornecedorController extends Controller
{
    public function __construct(
        protected FindUserSupplierUseCase $findUserSupplierUseCase,
        protected FindSupplierUseCase $findSupplierUseCase,
        protected CreateSupplierUseCase $createSupplierUseCase,
        protected UpdateSupplierUseCase $updateSupplierUseCase,
        protected DeleteSupplierUseCase $deleteSupplierUseCase,
    ) {}

    public function index(Restaurante $restaurante): AnonymousResourceCollection
    {
        $this->authorize('viewAny', [Fornecedor::class, $restaurante]);

        $output = $this->findUserSupplierUseCase->execute(auth()->user());

        return FornecedorResource::collection($output);
    }

    public function show(Fornecedor $fornecedor): FornecedorResource
    {
        $this->authorize('view', $fornecedor);

        $output = $this->findSupplierUseCase->execute($fornecedor->id);

        return new FornecedorResource($output);
    }

    public function store(StoreFornecedorRequest $request, Restaurante $restaurante): JsonResponse
    {
        $this->authorize('createForRestaurante', [Fornecedor::class, $restaurante]);

        $data = $request->validated();
        $input = new CreateSupplierInput(
            name: $data['nome'],
            phone: $data['telefone'],
            email: $data['email'],
            address: $data['endereco'],
            restaurantId: $restaurante->id,
        );

        $output = $this->createSupplierUseCase->execute($input);

        return (new FornecedorResource($output))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateFornecedorRequest $request, Fornecedor $fornecedor): FornecedorResource
    {
        $this->authorize('update', $fornecedor);

        $data = $request->validated();
        $input = new UpdateSupplierInput(
            id: $fornecedor->id,
            name: $data['nome'] ?? null,
            phone: $data['telefone'] ?? null,
            email: $data['email'] ?? null,
            address: $data['endereco'] ?? null,
            restaurantId: $data['restaurante_id'] ?? null,
        );

        $output = $this->updateSupplierUseCase->execute($input);

        return new FornecedorResource($output);
    }

    public function destroy(Fornecedor $fornecedor): JsonResponse
    {
        $this->authorize('delete', $fornecedor);

        $this->deleteSupplierUseCase->execute($fornecedor->id);

        return response()->json(["message" => "Fornecedor deletado com sucesso!"], 200);
    }
}
