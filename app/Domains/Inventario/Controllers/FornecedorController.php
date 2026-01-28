<?php

namespace App\Domains\Inventario\Controllers;

use App\Domains\Atendimento\Resources\ClienteResource;
use App\Domains\Inventario\Requests\Fornecedor\StoreFornecedorRequest;
use App\Domains\Inventario\Requests\Fornecedor\UpdateFornecedorRequest;
use App\Domains\Inventario\Resources\FornecedorResource;
use App\Domains\Inventario\Services\FornecedorService;
use App\Http\Controllers\Controller;
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
        return FornecedorResource::collection($this->fornecedorService->findAll());
    }

    public function show(int $id): FornecedorResource
    {
        $fornecedor = $this->fornecedorService->find($id);
        return new FornecedorResource($fornecedor);
    }

    public function store(StoreFornecedorRequest $request): FornecedorResource
    {
        $fornecedor = $this->fornecedorService->create($request->validated());
        return new FornecedorResource($fornecedor);
    }

    public function update(UpdateFornecedorRequest $request, int $id): FornecedorResource
    {
        $fornecedor = $this->fornecedorService->update($id, $request->validated());
        return new FornecedorResource($fornecedor);
    }
    public function destroy(int $id): JsonResponse
    {
        $this->fornecedorService->delete($id);
        return response()->json(["message" => "Fornecedor deletado com sucesso!"], 200);
    }
}
