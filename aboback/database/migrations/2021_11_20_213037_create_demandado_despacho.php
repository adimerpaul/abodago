<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandadoDespacho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandado_despacho', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('demandado_id');
            $table->foreign('demandado_id')->references('id')->on('demandados');
            $table->unsignedBigInteger('despacho_id');
            $table->foreign('despacho_id')->references('id')->on('despachos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandado_despacho');
    }
}
