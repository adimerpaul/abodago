<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Detalleproforma;
use App\Models\Precio;
use App\Models\Proforma;
use App\Models\Tramite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Precio::orderBy('nombre')->get();
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
        Precio::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Precio  $precio
     * @return \Illuminate\Http\Response
     */
    public function show(Precio $precio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Precio  $precio
     * @return \Illuminate\Http\Response
     */
    public function edit(Precio $precio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Precio  $precio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precio $precio)
    {
        $precio->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Precio  $precio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Precio $precio)
    {
        DB::SELECT("DELETE from detalleproformas where proforma_id=$precio->id");
        $precio->delete();
    }

    public function upprecio(Request $request){
        $proforma=Proforma::find($request->id);
        $proforma->total=$request->total;
        $proforma->save();

        DB::SELECT("DELETE from detalleproformas where proforma_id=$request->id");
        foreach ($request->datos as $r) {
            $detprof=new Detalleproforma;
            $detprof->nombre=$r['nombre'];
            $detprof->precio=$r['precio'];
            $detprof->proforma_id=$request->id;
            $detprof->save();
        }
    }

        public function impcosto(Request $request){
//        return $request;
        $proforma=new Proforma;
        $proforma->fecha=date('Y-m-d');
        $proforma->cliente_id=$request->cliente_id;
        $proforma->tramite_id=$request->tramite_id;
        $proforma->total=$request->total;
        $proforma->save();
        foreach ($request->datos as $r) {
            $detprof=new Detalleproforma;
            $detprof->nombre=$r['nombre'];
            $detprof->precio=$r['precio'];
            $detprof->proforma_id=$proforma->id;
            $detprof->save();
        }

        $total=0;
        $cliente=Cliente::find($request->cliente_id);
        $tramite=Tramite::where('id',$request->tramite_id)->with('requisitos')->first();
//        return $tramite;
        $cadena="<html>
        <style>
        table, th, td {
            border: 0.8px solid black;
          }
          .head tr td {
            border: 0;
          }
          table {
            border-collapse: collapse;
            width:100%;
          }
          .fondo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            opacity: 0.2;
        }
        .contact{
            width:6cm;
            height: 3cm;
        }
          </style>
          <body>
          <img class='fondo' src='img/logocastillogonzales.png'>
          <table class='head'>
          <tr>
              <!--td style='text-align:center'><img class='contact' src='img/contacto.png'></td-->
              <td></td>
              <td style='text-align: right'>Oruro, ".date('d/m/Y')."</td>
          </tr>
          <tr>
            <td colspan=2 style='text-align:center'>ESTIMACION DE COSTO</td>
          </tr>
          <tr>
              <td><b>Cliente:</b>".$cliente->nombre."</td>
              <td></td>
          </tr>
          </table><br>
          <table> <tr><th>CONCEPTO</th> <th>MONTO Bs.</th></tr>";
        foreach ($request->datos as $row) {
            $total+=$row['precio'];
            $cadena.='<tr>';
            $cadena.='<td>'.$row['nombre'].'</td>';
            $cadena.='<td>'.$row['precio'].'</td>';
            $cadena.='</tr>';
        }
        $cadena.="<tr><td><b>TOTAL Bs.</b></td><td>$total</td></tr>
        </table>
        <table> <tr><th>Requisitos</th></tr>";
        foreach ($tramite->requisitos as $row) {
            $cadena.='<tr>';
            $cadena.='<td>'.$row['nombre'].'</td>';
            $cadena.='</tr>';
        }
        $cadena.="
        </table>
        </body>
        </html>";

        return $cadena;
    }

    public function impproforma($id){
        $proforma=Proforma::find($id)->with('cliente')->with('tramite');
        $datos=Detalleproforma::where('proforma_id',$id)->get();
        $total=0;
        $cadena="<html>
        <style>
        table, th, td {
            border: 0.8px solid black;
          }
          .head tr td {
            border: 0;
          }
          table {
            border-collapse: collapse;
            width:100%;
          }
          .fondo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            opacity: 0.2;
        }
        .contact{
            width:6cm;
            height: 3cm;
        }
          </style>
          <body>
          <img class='fondo' src='img/logocastillogonzales.png'>
          <table class='head'>
          <tr>
              <!--td style='text-align:center'><img class='contact' src='img/contacto.png'></td-->
              <td></td>
              <td style='text-align: right'>Oruro, ".$proforma->fecha."</td>
          </tr>
          <tr>
            <td colspan=2 style='text-align:center'>ESTIMACION DE COSTO</td>
          </tr>
          <tr>
              <td><b>Cliente:</b>".$proforma->cliente['nombre']."</td>
              <td></td>
          </tr>
          </table><br>
          <table> <tr><th>CONCEPTO</th> <th>MONTO Bs.</th></tr>";
        foreach ($datos as $row) {
            $total+=$row['precio'];
            $cadena.='<tr>';
            $cadena.='<td>'.$row['nombre'].'</td>';
            $cadena.='<td>'.$row['precio'].'</td>';
            $cadena.='</tr>';
        }
        $cadena.="<tr><td><b>TOTAL Bs.</b></td><td>$total</td></tr>
        </table>
        <table> <tr><th>Requisitos</th></tr>";
        foreach ($proforma->tramite->requisitos as $row) {
            $cadena.='<tr>';
            $cadena.='<td>'.$row['nombre'].'</td>';
            $cadena.='</tr>';
        }
        $cadena.="
        </table>
        </body>
        </html>";


        return $cadena;

    }
}
