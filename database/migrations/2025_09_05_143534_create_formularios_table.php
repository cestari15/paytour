<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
             $table->string('ip')->nullable();
            $table->string('nome', 120)->nullable(false);
            $table->string('email', 120)->unique()->nullable(false);
            $table->string('telefone', 20)->unique()->nullable(false);
            $table->string('cargo_desejado', 120)->nullable(false);
            $table->string('escolaridade', 100)->nullable(false);
            $table->text('observacoes')->nullable(true);
            $table->string('arquivo')->nullable(false);
            $table->dateTime('data_hora')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios');
    }
};
