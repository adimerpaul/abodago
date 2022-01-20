<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleproformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleproformas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("precio");
            $table->unsignedBigInteger("proforma_id");
            $table->foreign("proforma_id")->references("id")->on("proformas")->cascadeOnDelete();
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
        Schema::dropIfExists('detalleproformas');
    }
}
