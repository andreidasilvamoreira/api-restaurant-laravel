<?php

namespace Tests\Feature;

use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestauranteUsuarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_pode_listar_usuarios_do_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $restaurante = Restaurante::factory()->create();
        $this->actingAs($user, 'sanctum')->getJson("/api/restaurantes/{$restaurante->id}/usuarios")->assertOk();
    }

    public function test_admin_pode_listar_usuarios_do_restaurante():void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();

        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true
        ]);

        $this->actingAs($user, 'sanctum')->getJson("/api/restaurantes/{$restaurante->id}/usuarios")->assertOk();
    }

    public function test_funcionario_ativo_nao_pode_listar_usuarios_do_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();

        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true
        ]);

        $this->actingAs($user, 'sanctum')->getJson("/api/restaurantes/{$restaurante->id}/usuarios")->assertStatus(403);
    }

    public function test_usuario_inativo_nao_pode_listar_usuarios_do_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();

        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => false
        ]);

        $this->actingAs($user, 'sanctum')->getJson("/api/restaurantes/{$restaurante->id}/usuarios")->assertStatus(403);
    }
}
