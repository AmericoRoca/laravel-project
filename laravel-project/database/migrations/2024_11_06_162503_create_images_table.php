<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id(); // Columna id auto-incremental
            $table->string('file_path'); // Ruta del archivo de la imagen, por ejemplo
            $table->string('description')->nullable(); // Descripción de la imagen, opcional
            $table->unsignedBigInteger('user_id')->nullable(); // Relación opcional con usuarios, si aplica
            $table->timestamps(); // Columnas created_at y updated_at automáticas

            // Si la imagen está asociada a usuarios u otra tabla, puedes añadir una clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
