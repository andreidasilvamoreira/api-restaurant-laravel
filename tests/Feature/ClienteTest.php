<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase;
    public function test_super_admin_acesso_universal_cliente(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN
        ]);

        $cliente = Cliente::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->getJson('/api/clientes');
        $response->assertStatus(200);
        $response = $this->deleteJson("/api/clientes/{$cliente->id}");
        $response->assertStatus(200);
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_criar_e_atualizar(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);

        $cliente = Cliente::factory()->create();
        $payload = Cliente::factory()->make()->toArray();
        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/clientes")->assertStatus(200);
        $this->postJson("/api/clientes", $payload)->assertStatus(403);
        $this->deleteJson("/api/clientes/{$cliente->id}")->assertStatus(403);
    }

    public function test_cliente_so_pode_ver_proprio_perfil_e_atualizar(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_CLIENTE]);

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id,
        ]);

        $payload = Cliente::factory()->make()->toArray();

        unset($payload['user_id']);

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/me/clientes")->assertStatus(200);
        $this->putJson("/api/me/clientes", $payload)->assertStatus(200);

        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_cliente_nao_pode_criar_dois_clientes(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);
        $payload = Cliente::factory()->make()->toArray();
        Cliente::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user, 'sanctum');

        $this->postJson("/api/clientes", $payload)->assertStatus(403);
    }

    public function test_cliente_nao_pode_criar_cliente_para_outro_user(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_CLIENTE]);
        $outro = User::factory()->create(['role' => User::ROLE_CLIENTE]);

        $this->actingAs($user, 'sanctum');

        $payload = Cliente::factory()->make([
            'user_id' => $outro->id,
        ])->toArray();

        $resp = $this->postJson('/api/clientes', $payload);
        $resp->assertStatus(201);
        $this->assertDatabaseHas('clientes', ['user_id' => $user->id]);
    }

}
