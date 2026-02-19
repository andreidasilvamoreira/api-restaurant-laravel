<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FornecedorTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_acesso_universal_fornecedor(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $fornecedor = Fornecedor::factory()->create();

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/fornecedores/{$fornecedor->id}")->assertOk();
        $this->deleteJson("/api/fornecedores/{$fornecedor->id}")->assertOk();
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_fornecedor(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER,
        ]);

        $restaurante = Restaurante::factory()->create();

        $payload = [
            'nome' => 'jurema',
            'telefone' => '62999998888',
            'email' => 'teste@hotmail.com',
            'endereco' => 'avenidaPaulista'
        ];

        $fornecedor = Fornecedor::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/fornecedores/{$fornecedor->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/fornecedores", $payload)->assertStatus(403);
        $this->putJson("/api/fornecedores/{$fornecedor->id}", $payload)->assertStatus(403);
        $this->deleteJson("/api/fornecedores/{$fornecedor->id}")->assertStatus(403);
    }

    public function test_admin_pode_tudo_menos_delete(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true,
        ]);

        $payload = [
            'nome' => 'jurema',
            'telefone' => '62999998888',
            'email' => 'teste@hotmail.com',
            'endereco' => 'avenidaPaulista',
        ];

        $fornecedor = Fornecedor::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/fornecedores/{$fornecedor->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/fornecedores", $payload)->assertStatus(201);
        $this->putJson("/api/fornecedores/{$fornecedor->id}", $payload)->assertOk();
        $this->deleteJson("/api/fornecedores/{$fornecedor->id}")->assertStatus(403);
    }

    public function test_funcionario_nao_pode_ver_nada(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE,
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true,
        ]);

        $payload = [
            'nome' => 'jurema',
            'telefone' => '62999998888',
            'email' => 'teste@hotmail.com',
            'endereco' => 'avenidaPaulista',
        ];

        $fornecedor = Fornecedor::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/fornecedores/{$fornecedor->id}")->assertStatus(403);
        $this->postJson("/api/restaurantes/{$restaurante->id}/fornecedores", $payload)->assertStatus(403);
        $this->putJson("/api/fornecedores/{$fornecedor->id}", $payload)->assertStatus(403);
        $this->deleteJson("/api/fornecedores/{$fornecedor->id}")->assertStatus(403);
    }

    public function test_dono_pode_tudo()
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE,
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_DONO,
            'ativo' => true,
        ]);

        $payload = [
            'nome' => 'jurema',
            'telefone' => '62999998888',
            'email' => 'teste@hotmail.com',
            'endereco' => 'avenidaPaulista',
        ];

        $fornecedor = Fornecedor::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/fornecedores/{$fornecedor->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/fornecedores", $payload)->assertStatus(201);
        $this->putJson("/api/fornecedores/{$fornecedor->id}", $payload)->assertOk();
        $this->deleteJson("/api/fornecedores/{$fornecedor->id}")->assertOk();
    }
}

