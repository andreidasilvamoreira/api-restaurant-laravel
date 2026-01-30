<?php

namespace App\Domains\Identity\Services;

use App\Domains\Identity\Repositories\RestauranteUsuarioRepository;
use App\Models\Restaurante;
use App\Models\User;
use DomainException;
use Illuminate\Support\Collection;

class RestauranteUsuarioService
{
    protected RestauranteUsuarioRepository $restauranteUsuarioRepository;

    public function __construct(RestauranteUsuarioRepository $restauranteUsuarioRepository)
    {
        $this->restauranteUsuarioRepository = $restauranteUsuarioRepository;
    }

    public function attach(Restaurante $restaurante, int $id, string $role): void
    {
        $user = User::findOrFail($id);

        $this->throwIf(
            $this->restauranteUsuarioRepository->exists($restaurante, $user->id),
            "Usuário já pertence a esse restaurante"
        );

        $this->restauranteUsuarioRepository->attach($restaurante, $user->id, $role);
    }

    public function detach(Restaurante $restaurante, int $id): void
    {
        $this->throwIf(
            !$this->restauranteUsuarioRepository->exists($restaurante, $id),
            "Usuário não pertence a esse restaurante"
        );

        $this->restauranteUsuarioRepository->detach($restaurante, $id);
    }

    public function updateRole(Restaurante $restaurante, int $id, string $role): void
    {
        $this->throwIf(
            !$this->restauranteUsuarioRepository->exists($restaurante, $id),
            "Usuário não pertence a esse restaurante"
        );

        $this->restauranteUsuarioRepository->updateRole($restaurante, $id, $role);
    }

    public function listarPorRestaurante(Restaurante $restaurante): Collection
    {
        return $this->restauranteUsuarioRepository->listPorRestaurante($restaurante);
    }

    private function throwIf(bool $condition, string $message): void
    {
        if ($condition) {
            throw new DomainException($message);
        }
    }
}
