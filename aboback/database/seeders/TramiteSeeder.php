<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TramiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tramites')->insert([
            ["id"=>1,"nombre"=>'IMPUESTO A LA TRANFERENCIA'],
            ["id"=>2,"nombre"=>'LEGALIZACION DE PLANO DEMOSTRATIVO'],
            ["id"=>3,"nombre"=>'CAMBIO DE NOMBRE Y CODIFICACION'],
            ["id"=>4,"nombre"=>'LINEA NVEL Y ORDEN DE AMURALAMIENTO'],
            ["id"=>5,"nombre"=>'TRAMITE DE EXEDENCIA'],
            ["id"=>6,"nombre"=>'APROBACION DE PLANO DE FRACCIONAMIENTO'],
            ["id"=>7,"nombre"=>'CERTIFICACION CATASTRAL (PRESTAMO BANCARIO)'],
            ["id"=>8,"nombre"=>'CERTIFICADO O INFORME DE DATOS TECNICOS PARA DDRR'],
            ["id"=>9,"nombre"=>'APROBACION DE PLANOS DE CONSTRUCCION'],
            ["id"=>10,"nombre"=>'COSNTRUCCIONES MAYORES O IGUALES A 3 PLANTAS'],
            ["id"=>11,"nombre"=>'GAMO DE LA LEY 247'],
        ]);
        DB::table('tramites')->insert([
            ["nombre"=>'CIVIL EJECUTIVO',"tipo"=>"PROCESO JUDICIAL"],
            ["nombre"=>'CIVIL ORDENAMIENTO',"tipo"=>"PROCESO JUDICIAL"],
            ["nombre"=>'FAMILIAR ASISTENCIA FAMILIAR',"tipo"=>"PROCESO JUDICIAL"],
            ["nombre"=>'FAMILIAR DIVORCIO',"tipo"=>"PROCESO JUDICIAL"],
            ["nombre"=>'PENAL',"tipo"=>"PROCESO JUDICIAL"],
        ]);
    }
}
