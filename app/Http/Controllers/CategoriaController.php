<?php

namespace App\Http\Controllers;

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
        return $this->categoriaService->findAll();
    }

    public function find(int $id)
    {
        $categoria = $this->categoriaService->find($id);
        return response()->json($categoria);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string',
            'restaurante_id' => 'required|exists:restaurantes,id',
        ]);
        $this->categoriaService->create($validated);
        return response()->json(['message' => 'Categoria cadastrada com sucesso'], 201);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string',
            'restaurante_id' => 'required|exists:restaurantes,id',
        ]);

        $this->categoriaService->update($validated, $id);
        return response()->json(['message' => 'Categoria atualizada com sucesso']);
    }

    public function delete(int $id)
    {
        $this->categoriaService->delete($id);
        return response()->json(["message" => "Categoria removida com sucesso"]);
    }
}
