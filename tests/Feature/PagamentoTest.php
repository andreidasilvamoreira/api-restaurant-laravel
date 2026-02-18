<?php

namespace Tests\Feature;

use App\Models\Pagamento;
use App\Models\Pedido;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagamentoTest extends TestCase
{
    use refreshDatabase;

    public function test_super_admin_acesso_universal_pagamento(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $pagamento = Pagamento::factory()->create();
        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/pagamentos/{$pagamento->id}")->assertOk();
        $this->deleteJson("/api/pagamentos/{$pagamento->id}")->assertOk();
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_pagamento(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER,
        ]);

        $pagamento = Pagamento::factory()->create();
        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/pagamentos/{$pagamento->id}")->assertOk();
        $this->deleteJson("/api/pagamentos/{$pagamento->id}")->assertStatus(403);
    }

    public function test_admin_pode_tudo_menos_deletar_pagamento(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true,
        ]);

        $pedido = Pedido::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $pagamento = Pagamento::factory()->create([
            'pedido_id' => $pedido->id,
        ]);

        $payload = Pagamento::factory()->make()->toArray();

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/pagamentos/{$pagamento->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/pagamentos", $payload)->assertStatus(201);
        $this->putJson("/api/pagamentos/{$pagamento->id}", $payload)->assertOk();
        $this->deleteJson("/api/pagamentos/{$pagamento->id}")->assertStatus(403);
    }

    public function test_funcionario_nao_pode_ver_editar_excluir()
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true
        ]);

        $pedido = Pedido::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $pagamento = Pagamento::factory()->create([
            'pedido_id' => $pedido->id,
        ]);

        $payload = Pagamento::factory()->make()->toArray();

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/pagamentos/{$pagamento->id}")->assertStatus(403);
        $this->putJson("/api/pagamentos/{$pagamento->id}", $payload)->assertStatus(403);
        $this->deleteJson("/api/pagamentos/{$pagamento->id}")->assertStatus(403);
    }
}
