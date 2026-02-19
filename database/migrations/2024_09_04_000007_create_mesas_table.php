<?php

use App\Models\Mesa;
use App\Models\Pedido;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->integer('capacidade');
            $table->string('status')->default(Mesa::STATUS_DISPONIVEL);
            $table->foreignId('restaurante_id')->constrained('restaurantes')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};
