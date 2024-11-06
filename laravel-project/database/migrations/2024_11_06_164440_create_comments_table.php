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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // ID auto-incremental
            $table->unsignedBigInteger('user_id'); // Relación con el usuario que hace el comentario
            $table->unsignedBigInteger('image_id'); // Relación con la imagen que recibe el comentario
            $table->text('content'); // Contenido del comentario
            $table->timestamps(); // Columnas de created_at y updated_at

            // Claves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
