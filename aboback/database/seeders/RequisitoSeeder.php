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
            ["tramite_id"=>1,"nombre"=>"TESTIMONIO DE PROPIEDAD DEL VENDEDOR"],
            ["tramite_id"=>1,"nombre"=>"FOLIO REAL ACTUALIZADO"],
            ["tramite_id"=>1,"nombre"=>"IMPUESTO ULTIMAS 5 GESTIONES"],
            ["tramite_id"=>1,"nombre"=>"TASAS POR SERVICIO ULTIMAS 5 GESTIONES"],
            ["tramite_id"=>1,"nombre"=>"COMPROBANTE CONEXIÓN ALCANTARRILLADO"],
            ["tramite_id"=>1,"nombre"=>"PLANO DEMOSTRATIVO A NOMBRE DEL VENDEDOR"],
            ["tramite_id"=>1,"nombre"=>"CERTIFICADO DE MATRIMONIO (SI CORRESPONDE)"],
            ["tramite_id"=>1,"nombre"=>"FOTOCOPIAS DE CARNET VENDEDORES "],
            ["tramite_id"=>1,"nombre"=>"FOTOCOPIAS DE CARNET COMPRADORES"],
            ["tramite_id"=>1,"nombre"=>"COMPROBANTE DE CAMBIO DE NOMBRE"],

            ["tramite_id"=>2,"nombre"=>"FOLIO REAL ACTUALIZADO"],
            ["tramite_id"=>2,"nombre"=>"CERTIFICADO DE MATRIMONIO (SI CORRESPONDE)"],
            ["tramite_id"=>2,"nombre"=>"CERTIFICADO DE NACIMIENTO (SI CORRESPONDE)"],
            ["tramite_id"=>2,"nombre"=>"CERTIFICADO SEGIP ORIGINAL"],
            ["tramite_id"=>2,"nombre"=>"FOTOCOPIAS DE CARNET"],
            ["tramite_id"=>2,"nombre"=>"AUTORIZACION DEL ACREEDOR EN CASO DE GRAVAMEN"],

            ["tramite_id"=>3,"nombre"=>"INFORME TECNICO PARA DERECHOS REALES"],
            ["tramite_id"=>3,"nombre"=>"TESTIMONIO DE PROPIEDAD MATRICULADO ACTUAL ORIGINAL"],
            ["tramite_id"=>3,"nombre"=>"TESTIMONIO DE PROPIEDAD MATRICULADO ANTERIOR ORIGINAL"],
            ["tramite_id"=>3,"nombre"=>"PAGO DE IMPUESTOS DE LAS TRES ULTIMAS GESTIONES"],
            ["tramite_id"=>3,"nombre"=>"PAGO DE TASAS POR SERVICIOS DE LAS TRES ULTIMAS GESTIONES"],
            ["tramite_id"=>3,"nombre"=>"1 FOTOCOPIA A COLOR DEL CARNET DEL (LOS) PROPIETARIO(S)"],
            ["tramite_id"=>3,"nombre"=>"COMPROBANTE DE PAGO POR CONEXIÓN DE ALCANTARILLADO"],
            ["tramite_id"=>3,"nombre"=>"FOLIO REAL ACTUALIZADO"],
            ["tramite_id"=>3,"nombre"=>"CERTIFICACION CATASTRAL"],
            ["tramite_id"=>3,"nombre"=>"PLANO LEGALIZADO"],

            ["tramite_id"=>4,"nombre"=>"ESCRITURA PUBLICA DE GRAVAMEN"],
            ["tramite_id"=>4,"nombre"=>"CEDULA DE IDENTIDAD DEL ACREEDOR Y DEUDOR"],
            ["tramite_id"=>4,"nombre"=>"NIT EN CASO DE PERSONA JURIDICA"],
            ["tramite_id"=>4,"nombre"=>"CERTIFICADO DE MATRIMONIO (SI CORRESPONDE)"],

            ["tramite_id"=>5,"nombre"=>"ESCRITURA PUBLICA DE CANCELACION"],
            ["tramite_id"=>5,"nombre"=>"CEDULA DE IDENTIDAD DEL ACREEDOR Y DEUDOR"],
            ["tramite_id"=>5,"nombre"=>"NIT EN CASO DE PERSONA JURIDICA"],

            ["tramite_id"=>6,"nombre"=>"ESCRITURA PUBLICA CON LA CUAL ADQUIRIO EL INMUEBLE"],
            ["tramite_id"=>6,"nombre"=>"CEDULA DE IDENTIDAD DEL PROPIETARIO DEL INMUEBLE FIRMADA AL MEDIO"],

            ["tramite_id"=>7,"nombre"=>"LEY DE LA ENTIDAD TERRITORIAL AUTONOMA CORRESPONDIENTE, EN CASO DE REGISTRO DE PROPIEDADES A FAVOR DE CUALQUIER ENTIDAD TERRITORIAL AUTONOMA"],
            ["tramite_id"=>7,"nombre"=>"LEY DE LA ENTIDAD TERRITORIAL AUTONOMA APROBADA POR LA ASAMBLEA LEGISLATIVA PLURINACIONAL, EN CASO DE ENAJENACION DE BIENES DE DOMINIO DE DOMINIO PUBLICO A FAVOR DE TERCEROS Y BIENES INMUEBLES DE PATRIMNIO INSTITUCIONAL"],
            ["tramite_id"=>7,"nombre"=>"PLANO APROBADO POR LA ENTIDAD COMPETENTE U OTROS DOCUMENTOS TECNICOS"],
            ["tramite_id"=>7,"nombre"=>"NUMETO DE IDENTIFICACION TRIBUTARIA - NIT"],
            ["tramite_id"=>7,"nombre"=>"CEDULA DE IDENTIDAD DEL EJECUTADO DE LA ENTIDAD TERRITORIAL AUTONOMA CORRESPONDIENTE"],

            ["tramite_id"=>8,"nombre"=>"ESCRITURA PUBLICA DE FUSION"],
            ["tramite_id"=>8,"nombre"=>"FOLIO REAL ORIGINAL DE LOS INMUEBLES A FUSIONAR"],
            ["tramite_id"=>8,"nombre"=>"CERTIFICADO CATASTRAL Y/O PLANO DE FUSION"],
            ["tramite_id"=>8,"nombre"=>"CEDULA DE IDENTIDAD DE LOS PROPIETARIOS"],

            ["tramite_id"=>9,"nombre"=>"ESCRITURA PUBLICA DE USUCAPION (UN ORIGINAL) O TESTIMONIO JUDICIAL (DOS ORIGINALES)"],
            ["tramite_id"=>9,"nombre"=>"IMPUESTO ANUAL DE LA ULTIMA GESTION"],
            ["tramite_id"=>9,"nombre"=>"IMPUESTO A LA TRANSFERENCIA GRATUITA (FORM. 430 Y A PARTIR DE DE JULIO SDEL 2016 DEBE PRESENTAR EL FORMULARIO DE LA GOBERNACION QUE CORRESPONDA)"],
            ["tramite_id"=>9,"nombre"=>"PLANO REFERENCIADO POR EL JUZGADO O PLANO APROBADO POR EL G.A.M.O."],
            ["tramite_id"=>9,"nombre"=>"CERTIFICADO CATASTRAL"],
            ["tramite_id"=>9,"nombre"=>"CEDULA DE IDENTIDAD DEL USUCAPISTA"],

            ["tramite_id"=>10,"nombre"=>"ESCRITURA PUBLICA DE DIVISION Y PARTICION"],
            ["tramite_id"=>10,"nombre"=>"INFORME TECNICO EMITIDO POR EL G.A.M.O. O RESOLUCION TECNICA ADMINISTRATIVA"],
            ["tramite_id"=>10,"nombre"=>"PLANIMETRIA O PLANO GENERAL APROBADO "],
            ["tramite_id"=>10,"nombre"=>"CEDULA DE IDENTIDAD DEL O LOS PROPIETARIOS"],
            ["tramite_id"=>10,"nombre"=>"CERTIFICADO CATASTRAL"],

            ["tramite_id"=>11,"nombre"=>"ESCRITURA PUBLICA DE PROPIEDAD HORIZONTAL"],
            ["tramite_id"=>11,"nombre"=>"CERTIFICADO CATASTRAL Y/O AVALUO CATASTRAL "],
            ["tramite_id"=>11,"nombre"=>"RESOLUCION ADMINISTRATIVA Y/O INFORME TECNICO Y CERTIFICADO DE PROPIEDAD HORIZONTAL"],
            ["tramite_id"=>11,"nombre"=>"IMPUESTO ANUAL DE LA ULTIMA GESTION "],
            ["tramite_id"=>11,"nombre"=>"TABLA DE FRACCIONAMIENTO "],
            ["tramite_id"=>11,"nombre"=>"PLANOS INDIVIDUALES APROBADOS DE TODAS LAS UNIDADES A FRACCIONAR (EN LOS G.A.M. QUE EXTIENDAN)"],
            ["tramite_id"=>11,"nombre"=>"PLANOS APROBADOS  DE FRACCIONAMIENTO EN PROPIEDAD HORIZONTAL Y PLANO DE CONSTRUCCION DEL G.A.M."],
            ["tramite_id"=>11,"nombre"=>"CEDULA DE IDENTIDAD DEL O LOS PROPIETARIOS EN CASO DE PERSONAS JURIDICAS EL NIT"],

            ["tramite_id"=>12,"nombre"=>"ESCRITURA PUBLICA CON LA QUE ADQUIRIO LA PROPIEDAD"],
            ["tramite_id"=>12,"nombre"=>"ESCRITURA PUBLICA DE ACLARACION DE CAMBIO DE JURISDICCION"],
            ["tramite_id"=>12,"nombre"=>"CEDULA DE IDENTIDAD DE PROPIETARIO "],
            ["tramite_id"=>12,"nombre"=>"CERTIFICADO PLANO GEO REFERENCIAL"],
            ["tramite_id"=>12,"nombre"=>"IMPUESTO ANUAL ULTIMA GESTION"],
            ["tramite_id"=>12,"nombre"=>"PLANO APROBADO POR EL G.A.M.  "],
            ["tramite_id"=>12,"nombre"=>"CARTA DE AUTORIZACION DE ARRASTRE DE GRAVAMEN (SI CORRESPONDE)"],

            ["tramite_id"=>13,"nombre"=>"ESCRITURA PUBLICA ANTE NOTARIO DE GOBIERNO"],
            ["tramite_id"=>13,"nombre"=>"CEDULA DE IDENTIDAD DEL CEDENTE"],
            ["tramite_id"=>13,"nombre"=>"NIT SI SE TRATA DE PERSONA JURIDICA"],

            ["tramite_id"=>14,"nombre"=>"TRAMITE DD.RR. CERTIFICADO DE TRADICION"],
            ["tramite_id"=>14,"nombre"=>"FORMULARIO DE CERTIFICACION LLENADO CORRECTAMENTE EN CASO DE SER TITUAL DEL BIEN INMUEBLE"],
            ["tramite_id"=>14,"nombre"=>"CEDULA DE IDENTIDAD"],

            ["tramite_id"=>15,"nombre"=>"TESTIMONIO DE HIPOTECA DE PRENDA SIN DESPLAZAMIENTO "],
            ["tramite_id"=>15,"nombre"=>"CEDULA DE IDENTIDAD DEL ACREEDOR Y DEUDOR"],
            ["tramite_id"=>15,"nombre"=>"NIT SI SE TRATA DE PERSONA JURIDICA"],

            ["tramite_id"=>16,"nombre"=>"FORMULARIO DE CERTIFICACION LLENADO CORRECTAMENTE EN CASO DE SER TITUAL DEL BIEN INMUEBLE"],
            ["tramite_id"=>16,"nombre"=>"CEDULA DE IDENTIDAD "],

            ["tramite_id"=>17,"nombre"=>"FORMULARIO DE CERTIFICACION LLENADO CORRECTAMENTE EN CASO DE SER TITUAL DEL BIEN INMUEBLE"],
            ["tramite_id"=>17,"nombre"=>"CEDULA DE IDENTIDAD "],

            ["tramite_id"=>18,"nombre"=>"FORMULARIO DE CERTIFICACION LLENADO CORRECTAMENTE EN CASO DE SER TITUAL DEL BIEN INMUEBLE"],
            ["tramite_id"=>18,"nombre"=>"CEDULA DE IDENTIDAD "],

            ["tramite_id"=>19,"nombre"=>"LA DOCUMENTACION OBSERVADA"],
            ["tramite_id"=>19,"nombre"=>"PRESENTACION DE DOCUMENTOS, BOLETAS ANTERIORES DE INGRESO Y LA BOLETA DE OBSERVACION DEL INSCRIPTOR "],
            ["tramite_id"=>19,"nombre"=>"CEDULA DE IDENTIDAD DEL PROPIETARIO"],

            ["tramite_id"=>20,"nombre"=>"MEMORIAL DE SOLICITUD DE DESARCHIVO"],
            ["tramite_id"=>20,"nombre"=>"BOLETA ANTERIOR DE INGRESO DE DOCUMENTO"],
            ["tramite_id"=>20,"nombre"=>"CEDULA DE IDENTIDAD DEL PROPIETARIO"],

            ["tramite_id"=>21,"nombre"=>"TESTIMONIO JUDICIAL DE DECLARATORIA DE HEREDEROS O ACEPTACION DE HERENCIA "],
            ["tramite_id"=>21,"nombre"=>"IMPUESTO ANUAL ULTIMA GESTION"],
            ["tramite_id"=>21,"nombre"=>"IMPUESTO A LA TRANSFERENCIA GRATUITA (FORMULATIO 430 Y FORMULARIO 900)"],
            ["tramite_id"=>21,"nombre"=>"CEDULA DE IDENTIDAD DE LOS HEREDEROS"],
            ["tramite_id"=>21,"nombre"=>"FOLIO REAL ACTUALIZADO"],

            ["tramite_id"=>22,"nombre"=>"ESCRITURA PUBLICA DE ANTICIPO DE LEGITIMA"],
            ["tramite_id"=>22,"nombre"=>"IMPUESTO ANUAL DE LA ULTIMA GESTION"],
            ["tramite_id"=>22,"nombre"=>"IMPUESTO A LA TRANSFERENCIA GRATUITA (FORMULATIO 430 Y FORMULARIO 900)"],
            ["tramite_id"=>22,"nombre"=>"PLANO APROBADO POR EL G.A.M.  A NOMBRE DEL BENEFICIARIO"],
            ["tramite_id"=>22,"nombre"=>"CEDULA DE IDENTIDAD DEL BENEFICIARIO"],
            ["tramite_id"=>22,"nombre"=>"CEDULA DE IDENTIDAD D3L CEDENTE"],

            ["tramite_id"=>23,"nombre"=>"CERTIFICADO DE REGISTRO DEL VEHICULO (RUAT)"],
            ["tramite_id"=>23,"nombre"=>"POLIZA DE IMPORTACION"],
            ["tramite_id"=>23,"nombre"=>"RESOLUCION DE INSCRIPCION DEL VEHICULO"],
            ["tramite_id"=>23,"nombre"=>"FORMULARIO DE REGISTRO DEL VEHICULO"],
            ["tramite_id"=>23,"nombre"=>"CEDULA DE IDENTIDAD A COLOR DEL VENDEDOR"],
            ["tramite_id"=>23,"nombre"=>"CEDULA DE IDENTIDAD A COLOR DEL COMPRADOR"],
            ["tramite_id"=>23,"nombre"=>"PODER ORIGINAL"],
            ["tramite_id"=>23,"nombre"=>"IMPUESTO ULTIMA GESTION"],
            ["tramite_id"=>23,"nombre"=>"3 FOTOS 3X3 FONDO ROJO (ALCALDIA)"],
            ["tramite_id"=>23,"nombre"=>"2 FOTOS 3X3 FONDO ROJO CON NUMERO DE CARNET (TRANSITO)"],

            ["tramite_id"=>24,"nombre"=>"PLANO DEMOSTRATIVO ORIGINAL"],
            ["tramite_id"=>24,"nombre"=>"TESTIMONIO DE PROPIEDAD MATRICULADO ACTUAL ORIGINAL"],
            ["tramite_id"=>24,"nombre"=>"FOTOCOPIA SIMPLE DEL TESTIMONIO ANTERIOR MATRICULADO EN D.D.R.R. O CON PARTIDA "],
            ["tramite_id"=>24,"nombre"=>"FOTOCOPIA SIMPLE DE PAGO IMPUESTO DE INMUEBLES ULTIMAS 5 GESTIONES"],
            ["tramite_id"=>24,"nombre"=>"FOTOCOPIA SIMPLE DE PAGO POR TASAS Y SERVICIOS ULTIMAS 5 GESTIONES"],
            ["tramite_id"=>24,"nombre"=>"FOTOCOPIA DE C.I. DE LOS PROPIETARIOS"],
            ["tramite_id"=>24,"nombre"=>"FOTOCOPIA SIMPLE DEL COMPROBANTE DE PAGO POR CONEXION DE ALCANTARILLADO"],
            ["tramite_id"=>24,"nombre"=>"FOTOGRAFIAS DEL BIEN INMUEBLE (FACHADA MAS LA VIA, FACHADA INTERIOR, HABITACIONES, CIELO, PATIO)"],
            ["tramite_id"=>24,"nombre"=>"PLANO DE FRACCIONAMIENTO APROBADO (SI CORRESPONDE)"],
            ["tramite_id"=>24,"nombre"=>"FIRMAR DECLARACION JURADA PARA  LA NO INSPECCION"],
            ["tramite_id"=>24,"nombre"=>"PLANO ESQUEMATICO PARA CODIFICACION (SI CORRESPONDE)"],

            ["tramite_id"=>25,"nombre"=>"PLANO DEMOSTRATIVO ACTUAL "],
            ["tramite_id"=>25,"nombre"=>"FOTOCOPIA DEL TESTIMONIO ACTUAL "],
            ["tramite_id"=>25,"nombre"=>"TESTIMONIO ANTERIOR MATRICULADO ORIGINAL"],
            ["tramite_id"=>25,"nombre"=>"FOTOCOPIA DE PAGO DE IMPUESTOS DE LAS DOS ULTIMAS GESTIONES"],
            ["tramite_id"=>25,"nombre"=>"FOTOCOPIA DE PAGO DE TASAS POR SERVICIOS DE LAS DOS ULTIMAS GESTIONES"],
            ["tramite_id"=>25,"nombre"=>"FOTOCOPIA A COLOR DEL CARNET  DEL (LOS) PROPIETARIO(S)"],

            ["tramite_id"=>26,"nombre"=>"FOTOCOPIA SIMPLE DEL TESTIMONIO ACTUAL MATRICULADO "],
            ["tramite_id"=>26,"nombre"=>"FOTOCOPIA SIMPLE DEL TESTIMONIO ANTERIOR MATRICULADO"],
            ["tramite_id"=>26,"nombre"=>"FOTOCOPIAS DEL PAGO DE IMPUESTO ULTIMAS DOS GESTIONES"],
            ["tramite_id"=>26,"nombre"=>"FOTOCOPIAS DEL PAGO DE TASAS POR SERVICIOS ULTIMAS DOS GESTIONES"],
            ["tramite_id"=>26,"nombre"=>"FOTOCOPIA A COLOR DEL CARNET  DEL (LOS) PROPIETARIO(S)"],

            ["tramite_id"=>27,"nombre"=>"FOTOCOPIAS DEL PLANO DEMOSTRATIVO A NOMBRE DEL PROPIETARIO ACTUAL"],
            ["tramite_id"=>27,"nombre"=>"FOTOCOPIAS DE LA MINUTA"],
            ["tramite_id"=>27,"nombre"=>"FOTOCOPIA SIMPLE DEL TESTIMONIO ANTERIOR MATRICULADO EN D.D.R.R. O CON PARTIDA  LEGALIZADA EN DIRECCION JURIDICA GAMO"],
            ["tramite_id"=>27,"nombre"=>"FOTOCOPIA DE PAGO DE IMPUESTO DE INMUEBLES ULTIMAS 5 GESTIONES"],
            ["tramite_id"=>27,"nombre"=>"FOTOCOPIA DE PAGO DE TASAS POR SERVICIOS ULTIMAS 5 GESTIONES"],
            ["tramite_id"=>27,"nombre"=>"FOTOCOPIA A COLOR DEL CARANET DE LOS COMPRADORES "],
            ["tramite_id"=>27,"nombre"=>"FOTOCOPIAS SIMPLE DEL COMPROBANTE DE PAGO POR CONEXIÓN DE ALCANTARILLADO"],

            ["tramite_id"=>28,"nombre"=>"MINUTA ORIGINAL "],
            ["tramite_id"=>28,"nombre"=>"FOTOCOPIAS PAGO DE IMPUESTOS ULTIMA GESTION"],
            ["tramite_id"=>28,"nombre"=>"FOTOCOPIA A COLOR DEL CARNET DE LOS COMPRADORES "],
            ["tramite_id"=>28,"nombre"=>"PLANO DEMOSTRATIVO"],
            ["tramite_id"=>28,"nombre"=>"FOLIO REAL"],

            ["tramite_id"=>29,"nombre"=>"FOTOCOPIAS SIMPLES DEL PLANO DEMOSTRATIVO "],
            ["tramite_id"=>29,"nombre"=>"FOTOCOPIAS DEL TESTIMONIO  DE PROPIEDAD ACTUAL  MATRICULADO "],
            ["tramite_id"=>29,"nombre"=>"FOTOCOPIAS DEL TESTIMONIO ANTERIOR MATRICULADO EN D.D.R.R."],
            ["tramite_id"=>29,"nombre"=>"FOTOCOPIAS PAGO DE IMPUESTOS DE LAS TRES ULTIMAS GESTIONES"],
            ["tramite_id"=>29,"nombre"=>"FOTOCOPIAS PAGO DE TASAS POR SERVICIOS DE LAS TRES ULTIMAS GESTIONES"],
            ["tramite_id"=>29,"nombre"=>"FOTOCOPIA A COLOR DEL CARNET DEL (LOS) PROPIETARIO(S)"],
            ["tramite_id"=>29,"nombre"=>"COMPROBANTE DE PAGO POR CONEXIÓN DE ALCANTARILLADO"],

            ["tramite_id"=>30,"nombre"=>"PLANO DEMOSTRATIVO "],
            ["tramite_id"=>30,"nombre"=>"TESTIMONIO DE PROPIEDAD MATRICULADO ACTUAL "],
            ["tramite_id"=>30,"nombre"=>"PAGO DE IMPUESTOS ULTIMA GESTION"],
            ["tramite_id"=>30,"nombre"=>"FOTOCOPIA A COLOR DEL CARNET DEL (LOS) PROPIETARIO(S)"],

            ["tramite_id"=>31,"nombre"=>"PLANO DEMOSTRATIVO CODIFICADO ORIGINAL"],
            ["tramite_id"=>31,"nombre"=>"TESTIMONIO DE PROPIEDAD MATRICULADO ORIGINAL"],
            ["tramite_id"=>31,"nombre"=>"TESTIMONIO DE PROPIEDAD MATRICULADO ANTERIOR ORIGINAL"],
            ["tramite_id"=>31,"nombre"=>"COMPROBANTE DE CAMBIO DE NOMBRE "],
            ["tramite_id"=>31,"nombre"=>"PAGO DE IMPUESTOS DE LAS CINCO ULTIMAS GESTIONES"],
            ["tramite_id"=>31,"nombre"=>"PAGO DE TASAS POR SERVICIOS DE LAS CINCO ULTIMAS GESTIONES"],
            ["tramite_id"=>31,"nombre"=>"FOTOCOPIAS A COLOR DEL CARNET DE LOS PROPIETARIOS"],
            ["tramite_id"=>31,"nombre"=>"COMPRONANTE DE PAGO POR CONEXIÓN DE ALCANTARILLADO"],

            ["tramite_id"=>32,"nombre"=>"PAGO DE IMPUESTOS DE LAS CINCO ULTIMAS GESTIONES"],
            ["tramite_id"=>32,"nombre"=>"PAGO DE TASAS POR SERVICIOS DE LAS CINCO ULTIMAS GESTIONES"],
            ["tramite_id"=>32,"nombre"=>"COMPROBANTE DE PAGO POR CONEXIÓN DE ALCANTARILLADO"],
            ["tramite_id"=>32,"nombre"=>"FOTOCOPIAS A COLOR DEL CARNET DEL (LOS) PROPIETARIO(S)"],


            ["tramite_id"=>33,"nombre"=>"DOCUMENTO DE PRESTAMO DE DINERO"],
            ["tramite_id"=>33,"nombre"=>"FORMULARIO DE FORMULARIO DE FIRMAS Y RUBRICAS "],
            ["tramite_id"=>33,"nombre"=>"CROQUIS DEL DOMICILIO DEMANDADO(S)"],
            ["tramite_id"=>33,"nombre"=>"FOTOS DEL FRONTIS DEL DOMICILIO DEMANDADO(S)"],

            
            ["tramite_id"=>34,"nombre"=>"ESCRITURA PUBLICA DE PRESTAMO DE DINERO"],
            ["tramite_id"=>34,"nombre"=>"FOLIO REAL ACTUALIZADO"],
            ["tramite_id"=>34,"nombre"=>"CROQUIS DEL DOMICILIO DEMANDADO(S)"],
            ["tramite_id"=>34,"nombre"=>"FOTOS DEL FRONTIS DEL DOMICILIO DEMANDADO(S)"],

            ["tramite_id"=>35,"nombre"=>"DOCUMENTO PRIVADO"],
            ["tramite_id"=>35,"nombre"=>"CROQUIS DEL DOMICILIO DEMANDADO(S)"],
            ["tramite_id"=>35,"nombre"=>"FOTOS DEL FRONTIS DEL DOMICILIO DEMANDADO(S)"],

            ["tramite_id"=>36,"nombre"=>"CERTIFICADO DE DEFUNCION DEL DE CUJUS "],
            ["tramite_id"=>36,"nombre"=>"CERTIFICADO DE MATRIMONIO (SI ES CASADO)"],  
            ["tramite_id"=>36,"nombre"=>"CERTIFICADO DE ESTADO CIVIL (SI ES SOLTERO) "],
            ["tramite_id"=>36,"nombre"=>"CERTIFICADO DE NACIMIENTO DE LOS HIJOS"],
            ["tramite_id"=>36,"nombre"=>"CERTIFICADO DE DESCENDENCIA"],
            ["tramite_id"=>36,"nombre"=>"CEDULA DE IDENTIDAD DE LOS HEREDEROS"],         
            ["tramite_id"=>36,"nombre"=>"FOLIO REAL O DOCUMENTACION QUE ACREDITE LA COMPETENCIA"],

            ["tramite_id"=>37,"nombre"=>"CEDULA DE IDENTIDAD DEL DEMANDANTE"],
            ["tramite_id"=>37,"nombre"=>"PARTIDA DE INSCRIPCION DE NACIMIENTO (LEGALIZADO SERECI)"],
            ["tramite_id"=>37,"nombre"=>"CERTIFICADO DE NACIMIENTO"],
            ["tramite_id"=>37,"nombre"=>"RESOLUCION ADMINITRATIVO DE RECHAZO DE SERECI (LEGALIZADO)"],
            ["tramite_id"=>37,"nombre"=>"CROQUIS DEL DOMICILIO DEMANDADO(S)"],
            ["tramite_id"=>37,"nombre"=>"FOTOS DEL FRONTIS DEL DOMICILIO DEMANDADO(S)"],

            ["tramite_id"=>38,"nombre"=>"CERTIFICADO DE MATRIMONIO"],
            ["tramite_id"=>38,"nombre"=>"FOTOCOPIAS DE CARNETS DE IDENTIDAD"],

            ["tramite_id"=>39,"nombre"=>"FOTOCOPIAS DE CARNETS DE IDENTIDAD DE LOS INTERESADOS"],
            ["tramite_id"=>39,"nombre"=>"CERTIFICADO DE MATRIMONIO"],
            ["tramite_id"=>39,"nombre"=>"CERTIFICADO DE DESCENDENCIA "],
            ["tramite_id"=>39,"nombre"=>"CERTIFICADO DE NO PROPIEDAD (DDRR)"],

            ["tramite_id"=>41,"nombre"=>"FOTOCOPIAS DE CARNETS DE IDENTIDAD DE LOS PROPIETARIOS"],
            ["tramite_id"=>41,"nombre"=>"ESCRITURA PUBLICA DE LOS PROPIETARIOS "],

            ["tramite_id"=>42,"nombre"=>"FOTOC0PIAS DE CARNETS DE IDENTIDAD DE LOS INTERESADOS "],
            ["tramite_id"=>42,"nombre"=>"CERTIFICADO DE MATRIMONIO "],
            ["tramite_id"=>42,"nombre"=>"CERTIFICADO DE NACIMIENTO (EN CASO DE TENR HIJOS EN COMUN)"],
            ["tramite_id"=>42,"nombre"=>"ACUERDO REGULADOR DE DIVORCIO (EN CASO DE SER UN DIVORCIO DE MUTUO ACUERDO)"],
            ["tramite_id"=>42,"nombre"=>"CROQUIS DEL DOMICILIO DEL DEMANDADO "],
            ["tramite_id"=>42,"nombre"=>"FOTOGRAFIAS DEL FRONTIS DEL DOMICILIO DEL DEMANDADO"],

            ["tramite_id"=>44,"nombre"=>"CERTIFICADO DE NACIMIENTO DEL REGISTRO CIVIL DE LA PARTE NEGADA"],
            ["tramite_id"=>44,"nombre"=>"FOTOCOPIAS DE CANRTES DE LA PARTE INTERESADA"],

            ["tramite_id"=>45,"nombre"=>"CERTIFICADO DE NACIMIENTO DE LOS MENORES"],
            ["tramite_id"=>45,"nombre"=>"CERTIFICADO DE TRABAJO O ALGUN DOCUMENTO QUE ACREDITE EL TRABAJO DEL OBLIGADO"],
            ["tramite_id"=>45,"nombre"=>"BOLETAS DE PAGO DEL OBLIGADO"],
            ["tramite_id"=>45,"nombre"=>"FACTURAS, RECIBOS Y COMPROBANTES QUE CERTIFIQUEN LOS GASTOS DEL MENOR"],
            ["tramite_id"=>45,"nombre"=>"FOTOCPIA DE CARNETS DE LOS PADRES "],
            ["tramite_id"=>45,"nombre"=>"FOTOCOPIAS DE CANRNETS DE LOS MENORES"],
            ["tramite_id"=>45,"nombre"=>"FOTOCOPIA DE CARNETS DE TESTIGOS(NO FAMILIARES)"],
            ["tramite_id"=>45,"nombre"=>"CROQUIS DEL DOMICILIO DE O LA DEMANDADO"],
            ["tramite_id"=>45,"nombre"=>"FOTO DEL FRONTIS DEL DOMICILIO DE O LA DEMANDADO"],

            ["tramite_id"=>46,"nombre"=>"FOTOCOPIA DE CARNTES DE INDENTIDAD DEL INTERESADO"],
            ["tramite_id"=>46,"nombre"=>"CERTIFICADO DE NACIMIENTO DEL INTERESADO"],
            ["tramite_id"=>46,"nombre"=>"CERTIFICADO DE TRABAJO O SUSTENTO ECONOMICO "],

            ["tramite_id"=>47,"nombre"=>"CERTIFICADO DE NACIMIENTO DE LOS MENORES"],
            ["tramite_id"=>47,"nombre"=>"CERTIFICADO DE TRABAJO O ALGUN DOCUMENTO QUE CERTIFIQUE EL TRABAJO DEL OBLIGADO"],
            ["tramite_id"=>47,"nombre"=>"FACTURAS, RECIBOS Y COMPROBASTES QUE CERTIFIQUEN LOS GASTOS DEL MENOR"],
            ["tramite_id"=>47,"nombre"=>"FOTOCOPIA DE CARNETS DE LOS PADRES "],
            ["tramite_id"=>47,"nombre"=>"FOTOCOPIA DE CARNETS DE LOS MENORES"],
            ["tramite_id"=>47,"nombre"=>"FOTOCOPIA DE CARNETS DE TESTIGOS(NO FAMILIARES)"],
            ["tramite_id"=>47,"nombre"=>"CROQUIS DEL DOMICILIO DE O LA DEMANDADO"],
            ["tramite_id"=>47,"nombre"=>"FOTO DEL FRONTIS DEL DOMICILIO DE O LA DEMANDADO"],

            ["tramite_id"=>48,"nombre"=>"CERTIFICADO DE MATRIMONIO"],
            ["tramite_id"=>48,"nombre"=>"FOTOCOPIAS LEGALIZADAS DEL PROCESO DE DIVORCIO"],
            ["tramite_id"=>48,"nombre"=>"DOCUMENTO PRIVADO DEL ACUERDO REGULADOR DE DIVISION Y PARTICION"],
            ["tramite_id"=>48,"nombre"=>"ESCRITURA PUBLICA DE CONTRATO DE PRESTAMO (SI CORRESPONDE)"],
            ["tramite_id"=>48,"nombre"=>"ESCRITURA PUBLICA DEL BIEN INMUEBLE"],
            ["tramite_id"=>48,"nombre"=>"FOLIO REAL DEL BIEN INMUEBLE"],


        ]);
    }
}
