<?php

namespace App\Domains\Identity\Controllers;

use App\Domains\Identity\Requests\User\StoreUserRequest;
use App\Domains\Identity\Requests\User\UpdateUserRequest;
use App\Domains\Identity\Resources\UserResource;
use App\Domains\Identity\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
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
        $this->authorize('viewAny', User::class);
        return UserResource::collection($this->userService->findAll());
    }

    public function show(User $user): UserResource
    {
        $this->authorize('view', $user);
        $user = $this->userService->find($user->id);
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request): UserResource
    {
        $this->authorize('create', User::class);
        $user = $this->userService->create($request->validated());
        return new UserResource($user);
    }

    public function update(User $user, UpdateUserRequest $request): UserResource
    {
        $this->authorize('update', $user);
        $user = $this->userService->update( $request->validated(), $user->id);
        return new UserResource($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);
        $this->userService->delete($user->id);
        return response()->json(['message' => 'Usuário deletado com sucesso!']);
    }
}
