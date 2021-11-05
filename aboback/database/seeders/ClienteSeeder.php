<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("clientes")->insert([
            ["nombre"=>"GAMO","TIPO"=>"EMPRESA","imagen"=>"gamo.jpg"],
            ["nombre"=>"BANCO SOL","TIPO"=>"EMPRESA","imagen"=>"sol.jpg"],
            ["nombre"=>"CLINICA NATIVIDAD","TIPO"=>"EMPRESA","imagen"=>"clinica.jpg"],
            ["nombre"=>"MULTICINES PLAZA","TIPO"=>"EMPRESA","imagen"=>"plaza.jpg"],
            ["nombre"=>"PLAZA","TIPO"=>"EMPRESA","imagen"=>"eplaza.jpg"],
        ]);

        DB::table("clientes")->insert([
           ["nombre"=>"ADIMER PAUL CHAMBI AJATA","ci"=>"7336199"]
        ]);

    }
}
