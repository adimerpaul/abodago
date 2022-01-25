<?php

namespace App\Http\Controllers;

use App\Models\Despacho;
use App\Models\Demandado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DespachoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Despacho::all()->with('demandados');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;
        $despacho=new Despacho;
        $despacho->fecha=$request->fecha;
        $despacho->hora=$request->hora;
        $despacho->tipo=$request->tipo;
        $despacho->juzgado=strtoupper($request->juzgado);
        $despacho->webid=$request->webid;
        $despacho->nurej=$request->nurej;
        $despacho->proceso=strtoupper($request->proceso);
        $despacho->ci=strtoupper($request->ci);
        $despacho->demandante=strtoupper($request->demandante);
        $despacho->representante=strtoupper($request->representante);
        $despacho->tramite_id=$request->tramite_id;
        $despacho->cliente_id=$request->cliente_id;
        $despacho->save();
        foreach ($request->requisitos as $row) {
            if ($row['estado'])
            DB::table('despacho_requisito')->insert(['requisito_id'=>$row['id'],'despacho_id'=>$despacho->id]);
        }
        foreach($request->demandados as $r){
            if ($r['ci']!=''){
                $dd=Demandado::where('ci',$r['ci'])->get();
                if($dd->count()==0){
                    $dem=DB::table('demandados')->insert(['ci'=>$r['ci'],'nombre'=>$r['nombre']]);
                    $demandado=$dem;
                }
                else{
                    Demandado::where('ci',$r['ci'])
                        ->update(['nombre'=>$r['nombre']]);
                    $demandado=$dd[0];
                }
                DB::table('demandado_despacho')->insert(['despacho_id'=>$despacho->id,'demandado_id'=>$demandado['id']]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despacho  $despacho
     * @return \Illuminate\Http\Response
     */
    public function show($cliente_id)
    {
//        return $cliente_id;
        return Despacho::where('cliente_id',$cliente_id)->with('requisitos')->with('tramite')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Despacho  $despacho
     * @return \Illuminate\Http\Response
     */
    public function edit(Despacho $despacho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Despacho  $despacho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Despacho $despacho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despacho  $despacho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despacho $despacho)
    {
        //
    }

    public function etiqueta($id){

    }

    public function impresion($id){
        $cadena='';
        $totaling=0;
        $totalegr=0;
        $adeudado=0;
        $cliente = DB::SELECT("SELECT c.nombre as nom,t.nombre as tram,t.tipo  from clientes c inner join despachos d on d.cliente_id= c.id inner join tramites t on d.tramite_id=t.id where d.id=$id");
        $egresos= db::select("select fecha,hora,monto,'' as recibo, concepto,'EGRESO' as tipo from egresos where despacho_id= $id");
        $ingresos= db::select("select fecha, hora, monto, recibo,'' as concepto,'INGRESO' as tipo from ingresos where despacho_id= $id");
        $path = 'app/public/imagenes/clinica.jpg';
        $cadena="<html>
        <style>table, th, td {
            border: 0.8px solid black;
          }
          table {
            border-collapse: collapse;
          }
          .fondo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            opacity: 0.2;
        }
          </style>
          <body>
          <img class='fondo' src='img/logocastillogonzales.png'>
        <div style='font-weight: bold;text-align:center'>GASTOS ". $cliente[0]->nom."</div>";
        $cadena.="<div style='font-weight: bold;text-align:center' >".$cliente[0]->tipo." ".$cliente[0]->tram."</div>";
        $cadena.="
        <div><table style='width:100%; border:0'><tr style='border:0'><td style='border:0'>
        <table style='width:100%'>
        <tr><td style='font-weight: bold' colspan=3>INGRESOS</td></tr>
        <tr><td style='font-weight: bold' >FECHA</td><td style='font-weight: bold'>RECIBO</td><td style='font-weight: bold'>BOLIVIANOS</td></tr>
        ";

        foreach ($ingresos as $ing) {
            # code...
            $cadena.="<tr><td>$ing->fecha</td><td>$ing->recibo</td><td>$ing->monto</td></tr>";
            $totaling+=$ing->monto;
        }
        $cadena.="</table> </td><td style='border:0'>

        <table style='width:100%'>
        <tr style='font-weight: bold'><td colspan=2>EGRESOS</td></tr>
        <tr style='font-weight: bold'><td>CONCEPTO</td><td>BOLIVIANOS</td></tr>";
        foreach ($egresos as $egr) {
            # code...
            $cadena.="<tr><td>$egr->concepto</td><td>$egr->monto</td></tr>";
            $totalegr+=$egr->monto;
        }
        $adeudado=$totaling - $totalegr;
        $cadena.="
        </table></td></tr></table>
        </div><br>
        <div style='width:100%'><table style='width:100%'><tr><td>INGRESOS TOTAL</td><td>$totaling</td><td>EGRESOS TOTAL</td><td>$totalegr</td></tr>
        <tr><td colspan=2>TOTAL ADEUDADO</td><td colspan=2>$adeudado</td></tr>
        </table></div></body></html>
        ";
        return $cadena;

    }
    public function impcliente($id){
        $cadena='';
        $totaling=0;
        $totalegr=0;
        $adeudado=0;
        $cliente = DB::SELECT("SELECT c.nombre as nom,t.nombre as tram,t.tipo  from clientes c inner join despachos d on d.cliente_id= c.id inner join tramites t on d.tramite_id=t.id where d.id=$id");
        $egresos= db::select("select fecha,hora,monto,'' as recibo, concepto,'EGRESO' as tipo from egotros where despacho_id= $id");
        $ingresos= db::select("select fecha, hora, monto, recibo,'' as concepto,'INGRESO' as tipo from ingresos where despacho_id= $id");

        $cadena="<html>
        <style>table, th, td {
            border: 0.8px solid black;
          }
          table {
            border-collapse: collapse;
          }
          .fondo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            opacity: 0.2;
        }</style>
        <body>
          <img class='fondo' src='img/logocastillogonzales.png'>
          <div style='font-weight: bold;text-align:center'>GASTOS ". $cliente[0]->nom."</div>";
        $cadena.="<div style='font-weight: bold;text-align:center' >".$cliente[0]->tipo." ".$cliente[0]->tram."</div>";
        $cadena.="
        <div><table style='width:100%; border:0'><tr style='border:0'><td style='border:0'>
        <table style='width:100%'>
        <tr><td style='font-weight: bold' colspan=3>INGRESOS</td></tr>
        <tr><td style='font-weight: bold' >FECHA</td><td style='font-weight: bold'>RECIBO</td><td style='font-weight: bold'>BOLIVIANOS</td></tr>
        </body>
        </html>";

        foreach ($ingresos as $ing) {
            # code...
            $cadena.="<tr><td>$ing->fecha</td><td>$ing->recibo</td><td>$ing->monto</td></tr>";
            $totaling+=$ing->monto;
        }
        $cadena.="</table> </td><td style='border:0'>

        <table style='width:100%'>
        <tr style='font-weight: bold'><td colspan=2>EGRESOS</td></tr>
        <tr style='font-weight: bold'><td>CONCEPTO</td><td>BOLIVIANOS</td></tr>";
        foreach ($egresos as $egr) {
            # code...
            $cadena.="<tr><td>$egr->concepto</td><td>$egr->monto</td></tr>";
            $totalegr+=$egr->monto;
        }
        $adeudado=$totaling - $totalegr;
        $cadena.="
        </table></td></tr></table>
        </div><br>
        <div style='width:100%'><table style='width:100%'><tr><td>INGRESOS TOTAL</td><td>$totaling</td><td>EGRESOS TOTAL</td><td>$totalegr</td></tr>
        <tr><td colspan=2>TOTAL ADEUDADO</td><td colspan=2>$adeudado</td></tr>
        </table></div>
        ";
        return $cadena;

    }

    public function reqfaltantes(Request $request){
        return DB::SELECT("SELECT * from requisitos r2 where r2.tramite_id=$request->tramite_id and r2.id not in 
        (SELECT r.id from despachos d, despacho_requisito dr, requisitos r  
        where d.id=dr.despacho_id AND dr.requisito_id=r.id and
        r.tramite_id=$request->tramite_id and d.id=$request->despacho_id)");
    }

    public function updrequisito(Request $request)
    {
        foreach ($request->requisitos as $row) {
            if ($row['estado'])
            DB::table('despacho_requisito')->insert(['requisito_id'=>$row['id'],'despacho_id'=>$request->despacho_id]);
        }
    }
}
