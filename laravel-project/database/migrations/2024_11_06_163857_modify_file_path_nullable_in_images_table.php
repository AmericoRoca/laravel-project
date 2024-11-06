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
    Schema::table('images', function (Blueprint $table) {
        $table->string('file_path')->default('default/path/to/image')->change(); // Valor predeterminado
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('file_path')->nullable(false)->change(); // Revertir a 'no nulo' si es necesario
        });
    }
};
