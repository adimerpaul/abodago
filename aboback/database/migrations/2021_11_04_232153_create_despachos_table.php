<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespachosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despachos', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->time("hora");
            $table->string("tipo");
            $table->string("juzgado");
            $table->string("webid");
            $table->string("nurej");
            $table->string("proceso");
            $table->string("demandante");
            $table->string("demandados");
            $table->unsignedBigInteger('tramite_id');
            $table->foreign('tramite_id')->references('id')->on('tramites');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
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
        Schema::dropIfExists('despachos');
    }
}
