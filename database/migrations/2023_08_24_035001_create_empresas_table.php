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
        Schema::create('empresas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre');
            $table->string('giro');
            $table->string('rfc')->nullable();
            $table->string('domicilio');
            $table->string('colonia');
            $table->string('cp')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('telefono')->nullable();
            $table->mediumText('mision')->nullable();
            $table->string('titular');
            $table->string('titular_puesto');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
