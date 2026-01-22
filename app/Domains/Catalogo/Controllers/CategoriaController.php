<?php

namespace App\Domains\Catalogo\Controllers;

use App\Domains\Catalogo\Requests\Categoria\StoreCategoriaRequest;
use App\Domains\Catalogo\Requests\Categoria\UpdateCategoriaRequest;
use App\Domains\Catalogo\Resources\CategoriaResource;
use App\Domains\Catalogo\Services\CategoriaService;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
{
    protected CategoriaService $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService= $categoriaService;
    }
    public function findAll()
    {
        $categoria = $this->categoriaService->findAll();
        return CategoriaResource::collection($categoria);
    }

    public function find(int $id)
    {
        $categoria = $this->categoriaService->find($id);
        return new CategoriaResource($categoria);
    }

    public function create(StoreCategoriaRequest $request)
    {
        $categoria = $this->categoriaService->create($request->validated());
        return new CategoriaResource($categoria);
    }

    public function update(UpdateCategoriaRequest $request, int $id)
    {
        $categoria = $this->categoriaService->update($request->validated(), $id);
        return new CategoriaResource($categoria);
    }

    public function delete(int $id)
    {
        $this->categoriaService->delete($id);
        return response()->json(["message" => "Financeiro removida com sucesso"]);
    }
}
