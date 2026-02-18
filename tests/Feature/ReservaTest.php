<?php

namespace Tests\Feature;

use App\Models\Mesa;
use App\Models\Reserva;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservaTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_acesso_universal_Reserva(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
        ]);
        $restaurante = Restaurante::factory()->create();

        $mesa = Mesa::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $reserva = Reserva::factory()->create();

        $payload = [
            'mesa_id' => $mesa->id,
            'restaurante_id' => $restaurante->id,
            'cliente_id' => $reserva->cliente_id,
            'data_reserva' => now()->addDay()->toDateTimeString(),
            'numero_pessoas' => 1,
            'status' => 'confirmada',
        ];

        $restaurante = Restaurante::factory()->create();
        $this->actingAs($user, 'sanctum');

        $this->postJson("/api/restaurantes/{$restaurante->id}/reservas", $payload)->assertStatus(201);
        $this->getJson("/api/reservas/$reserva->id" )->assertOk();
        $this->deleteJson("/api/reservas/$reserva->id" )->assertOk();
    }

    public function test_owner_pode_ver_mas_nao_pode_deletar_reserva(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_OWNER,
        ]);

        $reserva = Reserva::factory()->create();

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/reservas/$reserva->id" )->assertOk();
        $this->deleteJson("/api/reservas/$reserva->id" )->assertStatus(403);
    }

    public function test_admin_do_restaurante_pode_tudo(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_ADMIN,
            'ativo' => true
        ]);

        $payload = [
            'status' => 'confirmada'
        ];

        $reserva = Reserva::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $this->getJson("/api/reservas/$reserva->id" )->assertOk();
        $this->putJson("/api/reservas/$reserva->id", $payload)->assertOk();
        $this->deleteJson("/api/reservas/$reserva->id" )->assertOk();
    }

    public function test_funcionario_pode_ver_mas_nao_pode_deletar(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CLIENTE
        ]);

        $restaurante = Restaurante::factory()->create();
        $restaurante->users()->attach($user->id,[
            'role' => Restaurante::ROLE_FUNCIONARIO,
            'ativo' => true
        ]);

        $reserva = Reserva::factory()->create([
            'restaurante_id' => $restaurante->id,
        ]);

        $this->actingAs($user, 'sanctum');
        $this->getJson("/api/reservas/$reserva->id" )->assertOk();
        $this->deleteJson("/api/reservas/$reserva->id" )->assertStatus(403);
    }
}
