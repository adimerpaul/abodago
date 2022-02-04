<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("etapas")->insert([
            ["numero"=>"00", "nombre"=>"ELABORACION DEMANDA"],
            ["numero"=>"01", "nombre"=>"PRESENTACION DEMANDA"],
            ["numero"=>"01.1", "nombre"=>"AUTO INTERLOCUTORIO DE RECHAZO"],
            ["numero"=>"01.2", "nombre"=>"APELACION ANTERECHAZO"],
            ["numero"=>"02", "nombre"=>"SENTENCIA INICIAL"],
            ["numero"=>"02.1", "nombre"=>"MEDIDAS CAUTELARES"],
        ]);
    }
}
