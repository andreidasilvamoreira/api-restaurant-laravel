<?php

namespace App\Domains\Identity\Presentation\Controllers;

use App\Domains\Identity\Application\DTOs\RestauranteUsuario\CreateRestauranteUsuarioInput;
use App\Domains\Identity\Application\DTOs\RestauranteUsuario\UpdateRestauranteUsuarioInput;
use App\Domains\Identity\Application\UseCases\RestauranteUsuario\CreateRestauranteUsuarioUseCase;
use App\Domains\Identity\Application\UseCases\RestauranteUsuario\DeleteRestauranteUsuarioUseCase;
use App\Domains\Identity\Application\UseCases\RestauranteUsuario\FindRestauranteUsuarioUseCase;
use App\Domains\Identity\Application\UseCases\RestauranteUsuario\UpdateRestauranteUsuarioUseCase;
use App\Domains\Identity\Presentation\Requests\RestauranteUsuario\StoreRestauranteUsuarioRequest;
use App\Domains\Identity\Presentation\Requests\RestauranteUsuario\UpdateRestauranteUsuarioRequest;
use App\Domains\Identity\Presentation\Resources\RestauranteUsuarioResource;
use App\Http\Controllers\Controller;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RestauranteUsuarioController extends Controller
{
    public function __construct(
        protected FindRestauranteUsuarioUseCase $findRestauranteUsuarioUseCase,
        protected CreateRestauranteUsuarioUseCase $createRestauranteUsuarioUseCase,
        protected UpdateRestauranteUsuarioUseCase $updateRestauranteUsuarioUseCase,
        protected DeleteRestauranteUsuarioUseCase $deleteRestauranteUsuarioUseCase,
    ) {}

    public function index(Restaurante $restaurante): JsonResponse
    {
        $this->authorize('manageUsers', $restaurante);

        $output = $this->findRestauranteUsuarioUseCase->execute($restaurante->id);

        return response()->json([
            'restaurante' => $restaurante->nome,
            'data' => RestauranteUsuarioResource::collection($output),
        ]);
    }

    public function store(StoreRestauranteUsuarioRequest $request, Restaurante $restaurante): JsonResponse
    {
        $this->authorize('manageUsers', $restaurante);
        $data = $request->validated();

        $input = new CreateRestauranteUsuarioInput(
            restauranteId: $restaurante->id,
            userId: $data['user_id'],
            role: $data['role'],
            active: $data['ativo'],
        );

        $this->createRestauranteUsuarioUseCase->execute($input);

        return response()->json(['message' => 'Usuário vinculado ao restaurante com sucesso'], 201);
    }

    public function updateRole(Restaurante $restaurante, User $usuario, UpdateRestauranteUsuarioRequest $request): JsonResponse {
        $this->authorize('manageUsers', $restaurante);
        $data = $request->validated();

        $input = new UpdateRestauranteUsuarioInput(
            restauranteId: $restaurante->id,
            userId: $usuario->id,
            role: $data['role'] ?? null,
            active: $data['ativo'] ?? null,
        );

        $this->updateRestauranteUsuarioUseCase->execute($input);

        return response()->json(['message' => 'Role atualizado com sucesso'], 201);
    }

    public function destroy(Restaurante $restaurante, User $usuario): JsonResponse
    {
        $this->authorize('manageUsers', $restaurante);

        $this->deleteRestauranteUsuarioUseCase->execute($restaurante->id, $usuario->id);

        return response()->json(['message' => 'relacionamento excluído com sucesso']);
    }
}
