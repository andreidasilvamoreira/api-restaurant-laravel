<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_acesso_universal_pedido(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $restaurante = Restaurante::factory()->create();

        $pedido = Pedido::factory()->create([]);
        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/restaurantes/{$restaurante->id}/pedidos")->assertOk();
        $this->deleteJson("/api/pedidos/{$pedido->id}")->assertOk();
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_pedido(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER,
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true,
        ]);

        $pedido = Pedido::factory()->create();
        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/restaurantes/{$restaurante->id}/pedidos")->assertOk();
        $this->deleteJson("/api/pedidos/{$pedido->id}")->assertStatus(403);
    }

    public function test_admin_pode_tudo(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE,
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true,
        ]);

        $pedido = Pedido::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/pedidos/{$pedido->id}")->assertOk();
        $this->deleteJson("/api/pedidos/{$pedido->id}")->assertOk();
    }

    public function test_funcionario_pode_ver_mas_nao_pode_criar_deletar_atualizar_pedido()
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE,
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_FUNCIONARIO,
        ]);

        $pedido = Pedido::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $payload = Pedido::factory()->make([
            'restaurante_id' => $restaurante->id,
        ])->toArray();

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/pedidos/{$pedido->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/pedidos", $payload)->assertStatus(403);
        $this->deleteJson("/api/pedidos/{$pedido->id}")->assertStatus(403);
    }

    public function test_cliente_do_pedido_pode_ver_atualizar_deletar(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE,
        ]);

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id,
        ]);

        $restaurante = Restaurante::factory()->create();

        $pedido = Pedido::factory()->create([
            'restaurante_id' => $restaurante->id,
            'cliente_id' => $cliente->id,
            'status' => 'aberto'
        ]);

        $payload = [
            'status' => 'aberto'
        ];

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/pedidos/{$pedido->id}")->assertOk();
        $this->putJson("/api/pedidos/{$pedido->id}", $payload)->assertOk();
        $this->deleteJson("/api/pedidos/{$pedido->id}")->assertOk();
    }

    public function test_cliente_nao_pode_atualizar_ou_deletar_se_pedido_nao_estiver_aberto(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE,
        ]);

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id,
        ]);

        $restaurante = Restaurante::factory()->create();

        $pedido = Pedido::factory()->create([
            'restaurante_id' => $restaurante->id,
            'cliente_id' => $cliente->id,
            'status' => 'finalizado',
        ]);

        $payload = Pedido::factory()->make()->toArray();

        $this->actingAs($user, 'sanctum');

        $this->putJson("/api/pedidos/{$pedido->id}", $payload)->assertStatus(403);
        $this->deleteJson("/api/pedidos/{$pedido->id}")->assertStatus(403);
    }

}
