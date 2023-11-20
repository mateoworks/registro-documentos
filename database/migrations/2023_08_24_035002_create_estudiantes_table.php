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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->unsignedBigInteger('carrera_id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('genero')->nullable();
            $table->string('numero_control')->unique();
            $table->string('domicilio')->nullable();
            $table->string('email');
            $table->string('seguridad_social')->nullable();
            $table->string('no_seguridad_social')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
