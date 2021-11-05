<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DespachoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("despachos")->insert([
            "fecha"=>now(),
            "hora"=>now(),
            "tipo"=>"TRAMITE",
            "juzgado"=>"PUBLICO CIVIL Y COMERCIAL 11",
            "webid"=>"d0aa9",
            "nurej"=>"4014383",
            "proceso"=>"EJECUTIVO",
            "demandante"=>"ADIMER PAUL CHAMBI AJATA",
            "demandados"=>"JOSE FULANITO",
            'tramite_id'=>"1",
            'cliente_id'=>"6",
        ]);
    }
}
