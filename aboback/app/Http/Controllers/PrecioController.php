<?php

namespace App\Http\Controllers;

use App\Models\Precio;
use Illuminate\Http\Request;

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
        $precio->delete();
    }

    public function impcosto(Request $request){
        $cadena='';
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
          
          <tr><td style='text-align:center'><img class='contact' src='img/contacto.png'></td><td>Fecha:".date('d/m/Y')."</td></tr>
          <tr><td colspan=2 style='text-align:center'>ESTIMACION DE COSTO</td></tr>
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
        </body>
        </html>";
        return $cadena;
    }
}
