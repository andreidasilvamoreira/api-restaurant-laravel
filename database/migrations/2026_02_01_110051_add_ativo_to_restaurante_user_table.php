<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('restaurante_users', function (Blueprint $table) {
            $table->boolean('ativo')->default(true)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('restaurante_user', function (Blueprint $table) {

        });
    }
};
