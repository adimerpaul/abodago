<?php

namespace App\Http\Controllers;

use App\Models\Despacho;
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
        return Despacho::all();
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
        //
        $despacho=new Despacho;
        $despacho->fecha=$request->fecha;
        $despacho->hora=$request->hora;
        $despacho->tipo=$request->tipo;
        $despacho->juzgado=strtoupper($request->juzgado);
        $despacho->webid=$request->webid;
        $despacho->nurej=$request->nurej;
        $despacho->proceso=strtoupper($request->proceso);
        $despacho->demandante=strtoupper($request->demandante);
        $despacho->demandados=strtoupper($request->demandados);
        $despacho->tramite_id=$request->tramite_id;
        $despacho->cliente_id=$request->cliente_id;
        $despacho->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despacho  $despacho
     * @return \Illuminate\Http\Response
     */
    public function show(Despacho $despacho)
    {
        //
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

        $cadena="<style>table, th, td {
            border: 0.8px solid black;
          }
          table {
            border-collapse: collapse;
          }</style>
        <div style='text-align:center'>GASTOS". $cliente[0]->nom."</div>";
        $cadena.="<div style='text-align:center'>".$cliente[0]->tipo." ".$cliente[0]->tram."</div>";
        $cadena.="
        <div><table style='width:100%; border:0'><tr style='border:0'><td style='border:0'>
        <table style='width:100%'><tr><td colspan=3>INGRESOS</td></tr>
        <tr><td>FECHA</td><td>RECIBO</td><td>BOLIVIANOS</td></tr>";

        foreach ($ingresos as $ing) {
            # code...
            $cadena.="<tr><td>$ing->fecha</td><td>$ing->recibo</td><td>$ing->monto</td></tr>";
            $totaling+=$ing->monto;
        }
        $cadena.="</table> </td><td style='border:0'>      
      
        <table style='width:100%'><tr><td colspan=2>EGRESOS</td></tr>
        <tr><td>CONCEPTO</td><td>BOLIVIANOS</td></tr>";
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
}
