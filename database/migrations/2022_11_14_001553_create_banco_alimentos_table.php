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
        Schema::create('banco_alimentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',45);
            $table->unsignedBigInteger('municipio_id');  
        });

        Schema::table('banco_alimentos', function(Blueprint $table) {
            $table->foreign('municipio_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banco_alimentos');
    }
};
