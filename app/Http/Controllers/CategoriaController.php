<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Http\Services\CategoriaService;
use Illuminate\Http\Request;

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
        return response()->json(["message" => "Categoria removida com sucesso"]);
    }
}
