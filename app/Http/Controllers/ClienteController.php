<?php

namespace App\Http\Controllers;

use App\Http\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;
    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }
    public function findAll()
    {
        return $this->clienteService->findAll();
    }
    public function find(int $id)
    {
        return $this->clienteService->find($id);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'telefone' => 'integer',
            'endereco' => 'string',
            'user_id' => 'required|exists:users,id',
        ]);
        $this->clienteService->create($validated);
        return response()->json(["message" => "Cliente criado com sucesso!"], 201);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'telefone' => 'integer',
            'endereco' => 'string',
            'user_id' => 'integer|exists:users,id',
        ]);
        $this->clienteService->update($validated, $id);
        return response()->json(["message" => "Cliente atualizado com sucesso!"], 200);
    }

    public function delete(int $id)
    {
        $this->clienteService->delete($id);
        return response()->json(["message" => "Cliente deletado com sucesso!"], 200);
    }
}
