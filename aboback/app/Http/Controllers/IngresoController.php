<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\DB;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $ingreso=new Ingreso;
        $ingreso->user_id=$request->user()->id;
        $ingreso->despacho_id=$request->despacho_id;
        $ingreso->recibo='0';
        $ingreso->motivo=$request->motivo;
        $ingreso->monto=$request->monto;
        $ingreso->fecha=$request->fecha;
        $ingreso->hora=$request->hora;
        $ingreso->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingreso $ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        //
    }


    public function imprecibo($id){
        $ing=Ingreso::find($id);
        $cl=DB::SELECT("select * from clientes where id=(select cliente_id from despachos where id=".$ing->despacho_id.")");
        $tr=DB::SELECT("select * from tramites where id = (select tramite_id from despachos where id=".$ing->despacho_id.")");
        $number = $id;
        $length = 6;
        $string = substr(str_repeat(0, $length).$number, - $length);
        $formatter = new NumeroALetras();
        $mes=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $cadena="
        <style>
        .nom{
            font-family:'Brush Script MT', cursive;
        }
        table{
            
            border-collapse: collapse;
            width:100%;
        }
        .enc{
            font-size:8px
        }
        </style>
        <table>
        <tr>
        <td style='text-align:center;'><img src='img/logocastillogonzales2.png' style='width:4cm;height:2cm;'></td>

        </tr>
       </table>
        <div style='text-align:right;'><b>RECIBO</b> <span style='color:red'><b>No</b> $string</span></div>
        <div style='text-align:right;'><b>Bs. : </b>".$ing->monto."</div>
       
            
            
        
            <b> He recibido del Sr. (a): </b> 
        <div style='text-align:center;'>".$cl[0]->nombre."</div>
            <b> La suma de : </b>
        <div style='text-align:center;'>". $formatter->toWords($ing->monto)."  Bolivianos.</div>
            
            <b> Por concepto de: </b>
        <div style='text-align:center;'>".$tr[0]->nombre."</div><br>
            
        <div style='text-align:center;'>

        Oruro, ".date("d", strtotime($ing->fecha))." de ".$mes[intval(date("m", strtotime($ing->fecha))) - 1]." de ". date("Y", strtotime($ing->fecha))."
        </div>
            <br>
            <br>
        <div style='text-align:center;'><b>ENTREGUE CONFORME</b></div>
        
        ";
        return $cadena;

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingreso $ingreso)
    {
        //
        $ingreso->delete();
    }
}
