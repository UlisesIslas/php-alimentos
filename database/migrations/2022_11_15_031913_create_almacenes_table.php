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
        Schema::create('almacenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cadena_comercial_id');
            $table->unsignedBigInteger('alimentos_id');
        });

        Schema::table('almacenes', function(Blueprint $table) {
            $table->foreign('cadena_comercial_id')->references('id')->on('cadenas_comerciales');
            $table->foreign('alimentos_id')->references('id')->on('alimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('almacenes');
    }
};
