<?php

namespace App\Domains\Identity\Presentation\Controllers;

use App\Domains\Identity\Application\DTOs\User\CreateUserInput;
use App\Domains\Identity\Application\DTOs\User\UpdateUserInput;
use App\Domains\Identity\Application\UseCases\User\CreateUserUseCase;
use App\Domains\Identity\Application\UseCases\User\DeleteUserUseCase;
use App\Domains\Identity\Application\UseCases\User\FindAllUsersUseCase;
use App\Domains\Identity\Application\UseCases\User\FindUserUseCase;
use App\Domains\Identity\Application\UseCases\User\UpdateUserUseCase;
use App\Domains\Identity\Presentation\Requests\User\StoreUserRequest;
use App\Domains\Identity\Presentation\Requests\User\UpdateUserRequest;
use App\Domains\Identity\Presentation\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct(
        protected FindAllUsersUseCase $findAllUsersUseCase,
        protected FindUserUseCase $findUserUseCase,
        protected CreateUserUseCase $createUserUseCase,
        protected UpdateUserUseCase $updateUserUseCase,
        protected DeleteUserUseCase $deleteUserUseCase,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', User::class);

        $output = $this->findAllUsersUseCase->execute();

        return UserResource::collection($output);
    }

    public function show(User $user): UserResource
    {
        $this->authorize('view', $user);

        $output = $this->findUserUseCase->execute($user->id);

        return new UserResource($output);
    }

    public function store(StoreUserRequest $request): UserResource
    {
        $this->authorize('create', User::class);
        $data = $request->validated();

        $input = new CreateUserInput(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            role: $data['role'] ?? null,
        );

        $output = $this->createUserUseCase->execute($input);

        return new UserResource($output);
    }

    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $this->authorize('update', $user);
        $data = $request->validated();

        $input = new UpdateUserInput(
            id: $user->id,
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            password: $data['password'] ?? null,
            role: $data['role'] ?? null,
        );

        $output = $this->updateUserUseCase->execute($input);

        return new UserResource($output);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        $this->deleteUserUseCase->execute($user->id);

        return response()->json(['message' => 'Usuário deletado com sucesso!']);
    }
}
