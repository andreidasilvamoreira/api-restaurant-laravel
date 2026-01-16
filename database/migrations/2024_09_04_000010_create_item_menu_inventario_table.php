<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_menu_inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_menu_id')->constrained('itens_menu')->cascadeOnDelete();
            $table->foreignId('inventario_id')->constrained('inventarios')->cascadeOnDelete();
            $table->decimal('quantidade_necessaria', 10, 2);
            $table->unique(['item_menu_id', 'inventario_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('item_menu_inventario');
    }
};
