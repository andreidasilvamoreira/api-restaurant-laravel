<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_acesso_universal_categoria(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $categoria = Categoria::factory()->create();

        $this->actingAs($user, 'sanctum');
        $this->deleteJson("/api/categorias/{$categoria->id}")->assertOk();
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_categoria(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);

        $categoria = Categoria::factory()->create();

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/categorias")->assertOk();
        $this->deleteJson("/api/categorias/{$categoria->id}")->assertStatus(403);
    }

    public function test_dono_pode_tudo(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);
        $restaurante = Restaurante::factory()->create();

        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_DONO,
            'ativo' => true
        ]);

        $categoria = Categoria::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/categorias/{$categoria->id}")->assertOk();
        $this->deleteJson("/api/categorias/{$categoria->id}")->assertOk();
    }

    public function test_admin_pode_tudo_menos_delete(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true
        ]);

        $payload = Categoria::factory()->make([
            'restaurante_id' => $restaurante->id,
        ])->toArray();

        $categoria = Categoria::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');
        $response = $this->postJson("/api/restaurantes/{$restaurante->id}/categorias", $payload);
        $response->assertStatus(201);
        $response = $this->deleteJson("/api/categorias/{$categoria->id}");
        $response->assertStatus(403);
    }

    public function test_funcionario_nao_tem_acesso_create_mas_acessa_index(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();

        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true
        ]);

        $categoria = Categoria::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $payload = Categoria::factory()->make([
            'restaurante_id' => $restaurante->id,
        ])->toArray();

        $this->actingAs($user, 'sanctum');

        $response = $this->postJson("/api/restaurantes/{$restaurante->id}/categorias", $payload);
        $response->assertStatus(403);
        $response = $this->getJson("/api/categorias/{$categoria->id}");
        $response->assertOk();

    }
}
