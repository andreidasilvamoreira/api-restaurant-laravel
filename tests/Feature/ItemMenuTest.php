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

    public function test_index_de_itens_menu_retorna_apenas_itens_do_restaurante_da_rota(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE,
        ]);

        $restauranteA = Restaurante::factory()->create();
        $restauranteB = Restaurante::factory()->create();

        $restauranteA->users()->attach($user->id, [
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true,
        ]);

        $restauranteB->users()->attach($user->id, [
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true,
        ]);

        $categoriaA = Categoria::factory()->create([
            'restaurante_id' => $restauranteA->id,
        ]);

        $categoriaB = Categoria::factory()->create([
            'restaurante_id' => $restauranteB->id,
        ]);

        $itemA = ItemMenu::factory()->create([
            'categoria_id' => $categoriaA->id,
        ]);

        $itemB = ItemMenu::factory()->create([
            'categoria_id' => $categoriaB->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $response = $this->getJson("/api/restaurantes/{$restauranteA->id}/itens_menu");

        $response->assertOk();
        $response->assertJsonFragment(['id' => $itemA->id]);
        $response->assertJsonMissing(['id' => $itemB->id]);
    }

    public function test_nao_cria_item_menu_em_categoria_de_outro_restaurante(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE,
        ]);

        $restauranteA = Restaurante::factory()->create();
        $restauranteB = Restaurante::factory()->create();

        $restauranteA->users()->attach($user->id, [
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true,
        ]);

        $categoriaB = Categoria::factory()->create([
            'restaurante_id' => $restauranteB->id,
        ]);

        $payload = [
            'nome' => 'Prato cruzado',
            'descricao' => 'Nao deveria entrar',
            'preco' => 42.50,
            'disponibilidade' => 'disponivel',
            'categoria_id' => $categoriaB->id,
        ];

        $this->actingAs($user, 'sanctum');

        $this->postJson("/api/restaurantes/{$restauranteA->id}/itens_menu", $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['categoria_id']);
    }
}
