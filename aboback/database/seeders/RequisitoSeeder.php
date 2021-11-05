<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequisitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requisitos')->insert([
            ["tramite_id"=>1,"nombre"=>"3 FOTOCOPIAS PLANO DEMOSTRATIVO A NOMBRE DEL COMPRADOR ACTUAL"],
            ["tramite_id"=>1,"nombre"=>"1 FOTOCOPIAS DE LA MINUTA"],
            ["tramite_id"=>1,"nombre"=>"1 FOTOCOPIA DEL TESTIMONIO ANTERIOR LEGALIZADO POR EL GAMO"],
            ["tramite_id"=>1,"nombre"=>"1 FOTOCOPIA DE PAGO DE IMPUESTOS DE INMUEBLES ULTIMO 5 GESTIONES"],
            ["tramite_id"=>1,"nombre"=>"1 FOTOCOPIA DE PAGO DE TASAS POR SERVICIO ULTIMOS 5 GESTIONES"],
            ["tramite_id"=>1,"nombre"=>"1 FOTOCOPIA COMPROBANTE DE CONEXION DE ALCANTARILLADO"],

            ["tramite_id"=>2,"nombre"=>"1 FOTOCOPIA DEL TESTIMONIO ACTUAL"],
            ["tramite_id"=>2,"nombre"=>"1 PLANO DEMOSTRATIVO ORIGINAL CON TIMBRE"],
            ["tramite_id"=>2,"nombre"=>"2 FOTOCOPIAS DEL PLANO DEMOSTRATIVO"],
            ["tramite_id"=>2,"nombre"=>"1 FOTOCOPIA DEL TESTIMONIO ANTERIOR LEGALIZADO POR EL GAMO"],
            ["tramite_id"=>2,"nombre"=>"1 FOTOCOPIA DE PAGO DE IMPUESTOS DE INMUEBLES ULTIMO 2 GESTIONES"],
            ["tramite_id"=>2,"nombre"=>"1 FOTOCOPIA DE PAGO DE TASAS POR SERVICIO ULTIMOS 2 GESTIONES"],
            ["tramite_id"=>2,"nombre"=>"1 FOTOCOPIA DE CARNET DE IDENTIDAD"],

            ["tramite_id"=>3,"nombre"=>"3 FOTOCOPIAS DEL TESTIMONIO DE PROPIEDAD 1 LEGALIZADO POR EL GAMO"],
            ["tramite_id"=>3,"nombre"=>"1 FOTOCOPIA DEL TESTIMONIO ANTERIOR        "],
            ["tramite_id"=>3,"nombre"=>"1 PLANO DEMOSTRATIVO ORIGINAL"],
            ["tramite_id"=>3,"nombre"=>"3 FOTOCOPIAS PLANO DEMOSTRATIVO"],
            ["tramite_id"=>3,"nombre"=>"3 FOTOCOPIA DE PAGO DE IMPUESTOS DE INMUEBLES ULTIMO 5 GESTIONES."],
            ["tramite_id"=>3,"nombre"=>"1 FOTOCOPIA DE PAGO DE TASAS POR SERVICIO ULTIMOS 5 GESTIONESO"],
            ["tramite_id"=>3,"nombre"=>"1 FOTOCOPIA COMPROBANTE DE CONEXION DE ALCANTARILLADO "],
            ["tramite_id"=>3,"nombre"=>"1 FOTOCOPIA DE CARNET DE IDENTIDAD"],

        ]);
    }
}
