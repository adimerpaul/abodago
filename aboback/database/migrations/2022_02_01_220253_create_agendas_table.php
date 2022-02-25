<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('estado')->default('ACTIVO');
            $table->string('actividad');
            $table->string('proximopaso')->nullable();
            $table->date('fechaini');
            $table->time('horaini');
            $table->date('fechafin')->nullable();
            $table->time('horafin')->nullable();
            $table->date('fechaterminado')->nullable();
            $table->time('horaterminado')->nullable();
            $table->unsignedBigInteger('userterminado_id')->nullable();
            $table->foreign('userterminado_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('despacho_id')->nullable();
            $table->foreign('despacho_id')->references('id')->on('despachos');
            $table->unsignedBigInteger('etapa_id')->nullable();
            $table->foreign('etapa_id')->references('id')->on('etapas');
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
        Schema::dropIfExists('agendas');
    }
}
