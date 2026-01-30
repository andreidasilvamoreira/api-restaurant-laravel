<?php

namespace App\Domains\Identity\Controllers;

use App\Domains\Identity\Requests\User\StoreUserRequest;
use App\Domains\Identity\Requests\User\UpdateUserRequest;
use App\Domains\Identity\Resources\UserResource;
use App\Domains\Identity\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->findAll());
    }

    public function show(int $id): UserResource
    {
        $user = $this->userService->find($id);
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request): UserResource
    {
        $user = $this->userService->create($request->validated());
        return new UserResource($user);
    }

    public function update(int $id, UpdateUserRequest $request): UserResource
    {
        $user = $this->userService->update( $request->validated(), $id);
        return new UserResource($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->userService->delete($id);
        return response()->json(['message' => 'Usuário deletado com sucesso!']);
    }
}
