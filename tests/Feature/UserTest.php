<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_pode_listar_ver_criar_atualizar_e_deletar_users(): void
    {
        $superAdmin = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN
        ]);

        $outroUser = User::factory()->create();

        $payload = [
            'name' => 'Novo Nome',
            'email' => fake()->unique()->safeEmail(),
        ];

        $this->actingAs($superAdmin, 'sanctum');

        $response = $this->getJson("/api/users");
        $response->assertStatus(200);

        $response = $this->getJson("/api/users/{$outroUser->id}");
        $response->assertStatus(200);

        $response = $this->putJson("/api/users/{$outroUser->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $outroUser->id,
            'name' => 'Novo Nome',
        ]);

        $response = $this->deleteJson("/api/users/{$outroUser->id}");
        $response->assertStatus(200);
    }

    public function test_usuario_comum_nao_pode_listar_users(): void
    {
        $userCliente = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $this->actingAs($userCliente, 'sanctum');
        $response = $this->getJson("/api/users");
        $response->assertStatus(403);
    }

    public function test_usuario_pode_ver_e_atualizar_proprio_perfil(): void
    {
        $userCliente = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $payload = [
            'name' => 'Novo Nome',
            'email' => fake()->unique()->safeEmail(),
        ];

        $this->actingAs($userCliente, 'sanctum');

        $response = $this->getJson("/api/users/{$userCliente->id}");
        $response->assertStatus(200);
        $response = $this->putJson("/api/users/{$userCliente->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $userCliente->id,
            'name' => 'Novo Nome',
        ]);
    }

    public function test_usuario_nao_pode_ver_atualizar_ou_deletar_outro_user(): void
    {
        $userCliente = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $outroUser = User::factory()->create();

        $payload = [
            'name' => 'Novo Nome',
            'email' => fake()->unique()->safeEmail(),
        ];

        $this->actingAs($userCliente, 'sanctum');

        $response = $this->putJson("/api/users/{$outroUser->id}", $payload);
        $response->assertStatus(403);
        $response = $this->getJson("/api/users/{$outroUser->id}");
        $response->assertStatus(403);
        $response = $this->deleteJson("/api/users/{$outroUser->id}");
        $response->assertStatus(403);
    }
}
