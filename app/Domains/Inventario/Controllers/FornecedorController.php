<?php

namespace App\Domains\Inventario\Controllers;

use App\Domains\Atendimento\Resources\ClienteResource;
use App\Domains\Inventario\Requests\Fornecedor\StoreFornecedorRequest;
use App\Domains\Inventario\Requests\Fornecedor\UpdateFornecedorRequest;
use App\Domains\Inventario\Resources\FornecedorResource;
use App\Domains\Inventario\Services\FornecedorService;
use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FornecedorController extends Controller
{
    protected FornecedorService $fornecedorService;
    public function __construct(FornecedorService $fornecedorService)
    {
        $this->fornecedorService = $fornecedorService;
    }

    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Fornecedor::class);
        return FornecedorResource::collection($this->fornecedorService->findAll(auth()->user()));
    }

    public function show(int $id): FornecedorResource
    {
        $fornecedor = $this->fornecedorService->find($id);
        $this->authorize('view', $fornecedor);
        return new FornecedorResource($fornecedor);
    }

    public function store(StoreFornecedorRequest $request, Restaurante $restaurante): FornecedorResource
    {
        $this->authorize('createForRestaurante', [Fornecedor::class, $restaurante]);

        $data = $request->validated();
        $data['restaurante_id'] = $restaurante->id;

        $fornecedor = $this->fornecedorService->create($data);
        return new FornecedorResource($fornecedor);
    }

    public function update(UpdateFornecedorRequest $request, Fornecedor $fornecedor): FornecedorResource
    {
        $this->authorize('update', $fornecedor);
        $fornecedor = $this->fornecedorService->update($fornecedor->id, $request->validated());
        return new FornecedorResource($fornecedor);
    }
    public function destroy(Fornecedor $fornecedor): JsonResponse
    {
        $this->authorize('delete', $fornecedor);
        $this->fornecedorService->delete($fornecedor->id);
        return response()->json(["message" => "Fornecedor deletado com sucesso!"], 200);
    }
}
