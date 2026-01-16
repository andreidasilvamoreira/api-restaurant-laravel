<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('itens_pedido', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10,2);
            $table->text('observacoes')->nullable();
            $table->foreignId('pedido_id')->constrained()->cascadeOnDelete();
            $table->foreignId('item_menu_id')->constrained('itens_menu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itens_pedido');
    }
};
