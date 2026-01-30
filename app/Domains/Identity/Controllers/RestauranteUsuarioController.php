<?php

namespace App\Domains\Identity\Controllers;

use App\Domains\Identity\Requests\RestauranteUsuario\StoreRestauranteUsuarioRequest;
use App\Domains\Identity\Requests\RestauranteUsuario\UpdateRestauranteUsuarioRequest;
use App\Domains\Identity\Resources\RestauranteUsuarioResource;
use App\Domains\Identity\Services\RestauranteUsuarioService;
use App\Http\Controllers\Controller;
use App\Models\Restaurante;
use App\Models\User;

class RestauranteUsuarioController extends Controller
{
    protected RestauranteUsuarioService $restauranteUsuarioService;
    public function __construct(RestauranteUsuarioService $restauranteUsuarioService)
    {
        $this->restauranteUsuarioService = $restauranteUsuarioService;
    }

    public function index(Restaurante $restaurante)
    {
        $usuarios = $this->restauranteUsuarioService->listarPorRestaurante($restaurante);

        return response()->json([
            'restaurante' => $restaurante->nome,
            'data' => RestauranteUsuarioResource::collection($usuarios)
        ]);
    }

    public function store(StoreRestauranteUsuarioRequest $request, Restaurante $restaurante)
    {
        $this->restauranteUsuarioService->attach($restaurante, $request->user_id,  $request->role);
        return response()->json(['message' => 'Usuário vinculado ao restaurante com sucesso'], 201);
    }

    public function updateRole(Restaurante $restaurante, User $usuario, UpdateRestauranteUsuarioRequest $request)
    {
        $this->restauranteUsuarioService->updateRole($restaurante, $usuario->id,  $request->role);
        return response()->json(['message' => 'Role atualizado com sucesso'], 201);
    }

    public function destroy(Restaurante $restaurante, User $usuario)
    {
         $this->restauranteUsuarioService->detach($restaurante, $usuario->id);
         return response()->json(['message' => 'relacionamento excluído com sucesso']);
    }
}
