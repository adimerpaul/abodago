<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->id();
            $table->string("mes");
            $table->string("anio");
            $table->string("dias");
            $table->double("bonoantiguedad",11,2);
            $table->double("bononoche",11,2);
            $table->double("bonosemana",11,2);
            $table->double("bonocargo",11,2);
            $table->double("bonores",11,2);
            $table->double("bonootros",11,2);
            $table->double("afp",11,2);
            $table->double("rciva",11,2);
            $table->double("descuento",11,2);
            $table->double("descuentootros",11,2);
            $table->double("ganado",11,2);
            $table->double("liquido",11,2);
            $table->string("texto");
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('boletas');
    }
}
