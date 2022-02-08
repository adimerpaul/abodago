<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permisos')->insert([
            ["nombre"=>'Mi Agenda'],
            ["nombre"=>'Usuarios'],
            ["nombre"=>'Controlar Tramites'],
            ["nombre"=>'C Juridicos'],
            ["nombre"=>'C Naturales'],  
            ["nombre"=>'Demandados'],
            ["nombre"=>'Cotizacion'],
            ["nombre"=>'Mis Cotizaciones'],
        ]);
    }
}
