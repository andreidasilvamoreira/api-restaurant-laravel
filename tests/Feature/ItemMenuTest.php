<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\ItemMenu;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemMenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_acesso_universal_itens_menu(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        $restaurante = Restaurante::factory()->create();

        $itemMenu = ItemMenu::factory()->create();

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/restaurantes/{$restaurante->id}/itens_menu")->assertOk();
        $this->deleteJson("/api/itens_menu/{$itemMenu->id}")->assertOk();
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_item_menu(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);
        $itemMenu = ItemMenu::factory()->create();

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/itens_menu/{$itemMenu->id}")->assertOk();
        $this->deleteJson("/api/itens_menu/{$itemMenu->id}")->assertStatus(403);
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
        $categoria = Categoria::factory()->create([
            'restaurante_id' => $restaurante->id
        ]);
        $itemMenu = ItemMenu::factory()->create([
            'categoria_id' => $categoria->id
        ]);

        $payload = [
            'nome' => 'doce',
            'descricao' => 'doce',
            'preco' => 100,
            'disponibilidade' => 'disponivel',
            'categoria_id' => $categoria->id
        ];

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/itens_menu/{$itemMenu->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/itens_menu", $payload)->assertStatus(201);
        $this->putJson("/api/itens_menu/{$itemMenu->id}", $payload)->assertOk();
        $this->deleteJson("/api/itens_menu/{$itemMenu->id}")->assertOk();
    }

    public function test_funcionario_pode_ver_mas_nao_pode_criar_atualizar_deletar(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true
        ]);
        $categoria = Categoria::factory()->create([
            'restaurante_id' => $restaurante->id
        ]);
        $itemMenu = ItemMenu::factory()->create([
            'categoria_id' => $categoria->id
        ]);
        $payload = [
            'nome' => 'doce',
            'descricao' => 'doce',
            'preco' => 100,
            'disponibilidade' => 'disponivel',
            'categoria_id' => $categoria->id
        ];
        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/itens_menu/{$itemMenu->id}")->assertOk();
        $this->postJson("/api/restaurantes/{$restaurante->id}/itens_menu", $payload)->assertStatus(403);
        $this->putJson("/api/itens_menu/{$itemMenu->id}", $payload)->assertStatus(403);
        $this->deleteJson("/api/itens_menu/{$itemMenu->id}")->assertStatus(403);
    }
}
