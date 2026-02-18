<?php

namespace Tests\Feature;

use App\Models\Mesa;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MesaTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_acesso_universal_mesa(): void
    {
        $user = User::factory()->create([
            'role' => 'SUPER_ADMIN',
        ]);

        $mesa = Mesa::factory()->create();

        $this->actingAs($user, 'sanctum');
        $this->deleteJson("/api/mesas/{$mesa->id}")->assertOk();
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_mesa(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER
        ]);

        $mesa = Mesa::factory()->create();

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/mesas/{$mesa->id}")->assertOk();
        $this->deleteJson("/api/mesas/{$mesa->id}")->assertStatus(403);
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

        $mesa = Mesa::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/mesas/{$mesa->id}")->assertOk();
        $this->deleteJson("/api/mesas/{$mesa->id}")->assertOk();
    }

    public function test_funcionario_nao_tem_acesso(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id, [
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true
        ]);

        $payload = Mesa::factory()->make([
            'restaurante_id' => $restaurante->id,
        ])->toArray();

        $mesa = Mesa::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/mesas/{$mesa->id}")->assertStatus(403);
        $this->postJson("/api/restaurantes/{$restaurante->id}/mesas", $payload)->assertStatus(403);
        $this->deleteJson("/api/mesas/{$mesa->id}")->assertStatus(403);
    }
}
