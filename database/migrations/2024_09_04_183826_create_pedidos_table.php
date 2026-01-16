<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['aberto', 'preparando', 'finalizado', 'pago'])->default('aberto');
            $table->timestamp('data_hora')->useCurrent();
            $table->foreignId('restaurante_id')->constrained('restaurantes')->cascadeOnDelete();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->foreignId('mesa_id')->nullable()->constrained('mesas')->nullOnDelete();
            $table->foreignId('atendente_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
