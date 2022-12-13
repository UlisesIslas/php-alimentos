<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecoleccionAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recoleccion_alimentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('recoleccion_id');
            $table->unsignedBigInteger('alimento_id');
            $table->string('comentarios');
            $table->longText('foto');
        });

        Schema::table('recoleccion_alimentos', function (Blueprint $table) {
            $table->foreign('recoleccion_id')->references('id')->on('recolecciones');
            $table->foreign('alimento_id')->references('id')->on('alimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recoleccion_alimentos');
    }
}
