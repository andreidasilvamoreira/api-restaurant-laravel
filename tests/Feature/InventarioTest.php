<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use App\Models\Inventario;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventarioTest extends TestCase
{

    use RefreshDatabase;

    public function test_super_admin_acesso_universal_inventario(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $inventario = Inventario::factory()->create();

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/inventarios/{$inventario->id}")->assertOk();
        $this->deleteJson("/api/inventarios/{$inventario->id}")->assertOk();
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_fornecedor(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);

        $inventario = Inventario::factory()->create([]);

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/inventarios/{$inventario->id}")->assertOk();
        $this->deleteJson("/api/inventarios/{$inventario->id}")->assertStatus(403);
    }

    public function test_dono_pode_tudo(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_DONO,
            'ativo' => true
        ]);

        $fornecedor = Fornecedor::factory()->create([
            'restaurante_id' => $restaurante->id
        ]);

        $inventario = Inventario::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $payload = [
            'nome' => 'feijao',
            'unidade_medida' => 'kg',
            'preco_custo' => 20,
            'quantidade_atual' => 30,
            'fornecedor_id' => $fornecedor->id,
        ];
        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/inventarios/{$inventario->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/inventarios", $payload)->assertStatus(201);
        $this->putJson("/api/inventarios/{$inventario->id}", $payload)->assertOk();
        $this->deleteJson("/api/inventarios/{$inventario->id}")->assertOk();
    }

    public function test_admin_pode_tudo(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true
        ]);

        $fornecedor = Fornecedor::factory()->create([
            'restaurante_id' => $restaurante->id
        ]);

        $inventario = Inventario::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $payload = [
            'nome' => 'feijao',
            'unidade_medida' => 'kg',
            'preco_custo' => 20,
            'quantidade_atual' => 30,
            'fornecedor_id' => $fornecedor->id,
        ];
        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/inventarios/{$inventario->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/inventarios", $payload)->assertStatus(201);
        $this->putJson("/api/inventarios/{$inventario->id}", $payload)->assertOk();
        $this->deleteJson("/api/inventarios/{$inventario->id}")->assertOk();
    }

    public function test_funcionario_nao_pode_nada(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true
        ]);

        $fornecedor = Fornecedor::factory()->create([
            'restaurante_id' => $restaurante->id
        ]);

        $inventario = Inventario::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $payload = [
            'nome' => 'feijao',
            'unidade_medida' => 'kg',
            'preco_custo' => 20,
            'quantidade_atual' => 30,
            'fornecedor_id' => $fornecedor->id,
        ];
        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/inventarios/{$inventario->id}")->assertStatus(403);
        $this->postJson("/api/restaurantes/{$restaurante->id}/inventarios", $payload)->assertStatus(403);
        $this->putJson("/api/inventarios/{$inventario->id}", $payload)->assertStatus(403);
        $this->deleteJson("/api/inventarios/{$inventario->id}")->assertStatus(403);
    }
}
