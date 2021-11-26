<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("precios")->insert([
            ["nombre"=>"Valorado Fijos en DDRR por inmuebles","precio"=>142]
        ]);
    }
}
