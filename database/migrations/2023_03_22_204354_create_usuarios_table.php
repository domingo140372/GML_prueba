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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('cedula')->unique();
            $table->string('email',150)->unique();
            $table->string('celular');
            $table->string('direccion', 180);
            $table->unsignedBigInteger('id_pais');
            $table->unsignedBigInteger('id_categoria');
            $table->timestamps();
            $table->foreign('id_pais')->references('id')->on('paises');
            $table->foreign('id_categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
