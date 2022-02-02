<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Detalleproforma;
use App\Models\Proforma;
use Illuminate\Http\Request;

class ProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Proforma::with('detalleproformas')->with('cliente')->with('tramite')->get();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proforma  $proforma
     * @return \Illuminate\Http\Response
     */
    public function show(Proforma $proforma)
    {
        $cliente=Cliente::find($proforma->cliente_id);
        $detalleproformas=Detalleproforma::where('proforma_id',$proforma->id)->get();
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
        foreach ($detalleproformas as $row) {
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
        return  $cadena;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proforma  $proforma
     * @return \Illuminate\Http\Response
     */
    public function edit(Proforma $proforma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proforma  $proforma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proforma $proforma)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proforma  $proforma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proforma $proforma)
    {
        //
    }
}
