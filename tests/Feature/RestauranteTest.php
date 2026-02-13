<?php

namespace Tests\Feature;

use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestauranteTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_acesso_universal_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN
        ]);

        $restaurante = Restaurante::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/restaurantes/{$restaurante->id}");
        $response->assertStatus(200);
    }

    public function test_owner_pode_criar_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);

        $payload = Restaurante::factory()->make()->toArray();

        $response = $this->actingAs($user, 'sanctum')->postJson("/api/restaurantes", $payload);

        $response->assertStatus(201);

        $response->assertJsonFragment(['nome' => $payload['nome']]);
        $this->assertDatabaseHas('restaurantes', ['nome' => $payload['nome']]);
    }

    public function test_owner_pode_ver_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);

        $restaurante = Restaurante::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/restaurantes/{$restaurante->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $restaurante->id]);
    }

    public function test_owner_nao_pode_update_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);

        $restaurante = Restaurante::factory()->create();

        $payload = Restaurante::factory()->make()->toArray();

        $response = $this->actingAs($user, 'sanctum')->putJson("/api/restaurantes/{$restaurante->id}", $payload);

        $response->assertStatus(403);
        $this->assertDatabaseHas('restaurantes', ['id' => $restaurante->id, 'nome' => $restaurante->nome]);
    }

    public function test_owner_nao_pode_delete_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);

        $restaurante = Restaurante::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/restaurantes/{$restaurante->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('restaurantes', ['id' => $restaurante->id, 'nome' => $restaurante->nome]);
    }

    public function test_dono_pode_gerenciar_restaurante_associado(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();

        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_DONO,
            'ativo' => true
        ]);

        $payload = ['nome' => 'Nome atualizado'];

        $this->actingAs($user, 'sanctum');
        $response = $this->getJson("/api/restaurantes/{$restaurante->id}");
        $response->assertStatus(200);
        $response = $this->putJson("/api/restaurantes/{$restaurante->id}", $payload);
        $response->assertStatus(200);
        $response = $this->deleteJson("/api/restaurantes/{$restaurante->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('restaurantes', ['id' => $restaurante->id]);
    }

    public function test_admin_pode_ver_e_fazer_update_mas_nao_delete(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $payload = ['nome' => 'Nome atualizado'];

        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true
        ]);
        $this->actingAs($user, 'sanctum');

        $response = $this->getJson("/api/restaurantes/{$restaurante->id}");
        $response->assertStatus(200);
        $response = $this->putJson("/api/restaurantes/{$restaurante->id}", $payload);
        $response->assertStatus(200);
        $response = $this->deleteJson("/api/restaurantes/{$restaurante->id}");
        $response->assertStatus(403);
        $this->assertDatabaseHas('restaurantes', [
            'id' => $restaurante->id,
            'nome' => 'Nome atualizado',
        ]);
    }

    public function test_usuario_sem_permissao_nao_pode_ver_restaurante(): void
    {
        $user = User::factory()->create([
           'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/restaurantes/{$restaurante->id}");
        $response->assertStatus(403);
    }
}
