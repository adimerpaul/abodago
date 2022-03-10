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
            ["id"=>1,"nombre"=>'TRAMITE DD.RR. TRANSFERENCIA DE BIEN INMUEBLE',"tipo"=>"TRAMITE"],
            ["id"=>2,"nombre"=>'TRAMITE DD.RR. CORRECCION DE DATOS DE IDENTIDAD',"tipo"=>"TRAMITE"],
            ["id"=>3,"nombre"=>'TRAMITE DD.RR. CORRECCION DE DATOS TECNICOS',"tipo"=>"TRAMITE"],
            ["id"=>4,"nombre"=>'TRAMITE DD.RR. GRAVAMEN ',"tipo"=>"TRAMITE"],
            ["id"=>5,"nombre"=>'TRAMITE DD.RR. CANCELACION DE GRAVAMEN ',"tipo"=>"TRAMITE"],
            ["id"=>6,"nombre"=>'TRAMITE DD.RR. MATRICULACION DE INMUEBLE',"tipo"=>"TRAMITE"],
            ["id"=>7,"nombre"=>'TRAMITE DD.RR. MATRICULACION, INSPECCION Y TRANSFERENCIA DE BIENES INMUEBLES DEL ESTADO Y DEMAS ENTIDADES TERRITORIALES AUTONOMAS.',"tipo"=>"TRAMITE"],
            ["id"=>8,"nombre"=>'TRAMITE DD.RR. INSCRIPCION DE FUSION',"tipo"=>"TRAMITE"],
            ["id"=>9,"nombre"=>'TRAMITE DD.RR. INSCRIPCION DE USUCAPION',"tipo"=>"TRAMITE"],
            ["id"=>10,"nombre"=>'TRAMITE DD.RR. INSCRIPCION DE DIVISION Y PARTICION',"tipo"=>"TRAMITE"],
            ["id"=>11,"nombre"=>'TRAMITE DD.RR. INSCRIPCION DE PROPIEDAD HORIZONTAL ',"tipo"=>"TRAMITE"],
            ["id"=>12,"nombre"=>'TRAMITE DD.RR. CAMBIO DE JURISDICCION',"tipo"=>"TRAMITE"],
            ["id"=>13,"nombre"=>'TRAMITE DD.RR. CESION DE AREAS',"tipo"=>"TRAMITE"],
            ["id"=>14,"nombre"=>'TRAMITE DD.RR. CERTIFICADO DE TRADICION',"tipo"=>"TRAMITE"],
            ["id"=>15,"nombre"=>'TRAMITE DD.RR. PRENDA SIN DESPLAZAMIENTO',"tipo"=>"TRAMITE"],
            ["id"=>16,"nombre"=>'TRAMITE DD.RR. CERTIFICADO TREINTAÑAL',"tipo"=>"TRAMITE"],
            ["id"=>17,"nombre"=>'TRAMITE DD.RR. CERTIFICADO DE PROPIEDAD',"tipo"=>"TRAMITE"],
            ["id"=>18,"nombre"=>'TRAMITE DD.RR. CERTIFICADO DECENAL',"tipo"=>"TRAMITE"],
            ["id"=>19,"nombre"=>'TRAMITE DD.RR. REINGRESO DE DOCUMENTOS DESARCHIVO DE DOCUMENTOS',"tipo"=>"TRAMITE"],
            ["id"=>20,"nombre"=>'TRAMITE DD.RR. DESARCHIVO DE DOCUMENTOS',"tipo"=>"TRAMITE"],
            ["id"=>21,"nombre"=>'TRAMITE DD.RR. ACEPTACION DE HERENCIA',"tipo"=>"TRAMITE"],
            ["id"=>22,"nombre"=>'TRAMITE DD.RR. ANTICIPO DE LEGITIMA',"tipo"=>"TRAMITE"],
            ["id"=>23,"nombre"=>'TRAMITE TRANSFERENCIA DE VEHICULO',"tipo"=>"TRAMITE"],
            ["id"=>24,"nombre"=>'TRAMITE G.A.M.O. CAMBIO DE NOMBRE Y CODIFICACION',"tipo"=>"TRAMITE"],
            ["id"=>25,"nombre"=>'TRAMITE G.A.M.O. LEGALIZACION DE PLANO DEMOSTRATIVO',"tipo"=>"TRAMITE"],
            ["id"=>26,"nombre"=>'TRAMITE G.A.M.O. LEGALIZACION DE PLANO DEMOSTRATIVO EXPRESS',"tipo"=>"TRAMITE"],
            ["id"=>27,"nombre"=>'TRAMITE G.A.M.O. PAGO DE IMPUESTO A LA TRANSFERENCIA',"tipo"=>"TRAMITE"],
            ["id"=>28,"nombre"=>'TRAMITE G.A.M.O. PAGO DE IMPUESTO A LA TRANSFERENCIA EXPRESS',"tipo"=>"TRAMITE"],
            ["id"=>29,"nombre"=>'TRAMITE G.A.M.O. CERTIFICACION GENERAL O INFORME TECNICO ',"tipo"=>"TRAMITE"],
            ["id"=>30,"nombre"=>'TRAMITE G.A.M.O. CERTIFICACION GENERAL O INFORME TECNICO EXPRESS',"tipo"=>"TRAMITE"],
            ["id"=>31,"nombre"=>'TRAMITE G.A.M.O. CERTIFICADO CATASTRAL Y PRESTAMO BANCARIO',"tipo"=>"TRAMITE"],
            ["id"=>32,"nombre"=>'TRAMITE G.A.M.O. DE EXCEDENCIA ',"tipo"=>"TRAMITE"],
            ["id"=>33,"nombre"=>'PROCESO CIVIL MONITORIO EJECUTIVO',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>34,"nombre"=>'PROCESO CIVIL COACTIVO',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>35,"nombre"=>'PROCESO RECONOCIMIENTO DE FIRMAS RUBRICAS',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>36,"nombre"=>'PROCESO VOLUNTARIO DE ACEPTACION DE HERENCIA',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>37,"nombre"=>'PROCESO VOLUNTARIO DE CANCELACION DE PARTIDA DE NACIMIENTO',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>38,"nombre"=>'PROCESO FAMILIAR DE NULIDAD DE MATRIMONIO O DE UNION LIBRE',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>39,"nombre"=>'PROCESO FAMILIAR DE NULIDAD DE ACUERDOS EN LA VIA VOLUNTARIA NOTARIAL',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>40,"nombre"=>'PROCESO FAMILIAR DE DIVISION Y PARTICION DE BIENES GANANCIALES CUANDO NO SE LO TRAMITEN EN EJECUCION DE PROCESO DE DIVORCIO',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>41,"nombre"=>'PROCESO FAMILIAR DE DETERMINACION DE BIENES PROPIOS CUANDO EXISTA DESACUERDO SOBRE SU CALIDAD',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>42,"nombre"=>'PROCESO FAMILIAR EXTRAORDINARIO DE DIVORCIO ',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>43,"nombre"=>'PROCESO FAMILIAR EXTRAORDINARIO DE NEGACION DE MATERNIDAD O PATERNIDAD',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>44,"nombre"=>'PROCESO FAMILIAR EXTRAORDINARIO DE COMPROBACION DE MATRIMONIO O DE UNION LIBRE',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>45,"nombre"=>'PROCESO FAMILIAR EXTRAORDINARIO DE ASISTENCIA FAMILIAR',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>46,"nombre"=>'PROCESO DE RESOLUCION INMEDIATA ENMANCIPACION POR DESACUERDO',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>47,"nombre"=>'PROCESO DE RESOLUCION INMEDIATA DE ASISTENCIA FAMILIAR CUANDO EXISTA ACUERDO ',"tipo"=>"PROCESO JUDICIAL"],
            ["id"=>48,"nombre"=>'PROCESO DE RESOLUCION INMEDIATA HOMOLOGACION DE DIVISION Y PARTICION',"tipo"=>"PROCESO JUDICIAL"],
        ]);
    }
}
