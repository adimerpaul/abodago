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
        $ingreso->recibo=$request->recibo;
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
            border: 1px solid black;
            border-collapse: collapse;
        }
        .enc{
            font-size:6px
        }
        </style>
        <table style='width:100%; border:0px'><tr><td>
        <table>
        <tr style='border-bottom:1px solid black'>
        <td><img src='img/logocastillogonzales2.png' style='width:2cm;height:1cm;'></td>
        <td>
        <img  src='img/ubicacion.jpg' style='width:0.2cm;height:0.2cm'> <span class='enc'>La Plata No. 6254 <br> entre Sucre y Murguia Frente Cine Hollywood</span><br>
        <img  src='img/correo.jpg' style='width:0.2cm;height:0.2cm'><span class='enc'> gonzalesdelcastillomarcelo@hotmail.com </span><br>
        <img  src='img/telf.png' style='width:0.2cm;height:0.2cm'> <span class='enc'>Cel: 78611101</span>
        </td>
        <td><h2><b>RECIBO</b></h2></td>
        <td>
            <b>Bs. : </b>".$ing->monto."<br>
            <span style='color:red'><b>No</b> $string</span>
        </td>
        </tr>
        <tr>
        <td colspan=4>
            <b> He recibido del Sr. (a): </b>".$cl[0]->nombre."
            <br>
            <b> La suma de : </b>". $formatter->toWords($ing->monto)."  Bolivianos.
            <br>
            <b> Por concepto de: </b>".$tr[0]->nombre."<br>
            
        </td>
        <tr>
        <tr>
        <td><b> Efectivo:</b> X </td>
        <td><b> Cheque N:</b></td>
        <td><b> Banco: </b></td>
        <td><b> T/C:</b></td>
        </tr>
        <tr>
        <td colspan=2 style='text-align:justify; '><b> Total :</b></td>
        <td  style='text-align:justify;' ><b> A cuenta: </b></td>
        <td  style='text-align:justify; '><b> Saldo:</b></td>
        
        </tr>
        <tr>
        <td colspan=4 style='text-align:center; width:100%'> 
        Oruro, ".date("d", strtotime($ing->fecha))." de ".$mes[intval(date("m", strtotime($ing->fecha))) - 1]." de ". date("Y", strtotime($ing->fecha))."
        <td>
        </tr>
        <tr>
        <td colspan=2 class='nom' style='text-align:center; width:50%'>Marcelo J. Gonzales Del Castillo</td>
        <td colspan=2 style='text-align:center; width:50%'></td>
        </tr>
        <tr>
        <td colspan=2 style='text-align:center;  width:50%'><b>RECIBI CONFORME</b></td>
        <td colspan=2 style='text-align:center; width:50% '><b>ENTREGUE CONFORME</b></td>
        </tr>
        
        </table>
        </td>
        <td>
        <table>
        <tr style='border-bottom:1px solid black'>
        <td><img src='img/logocastillogonzales2.png' style='width:2cm;height:1cm'></td>
        <td>
        <img  src='img/ubicacion.jpg' style='width:0.2cm;height:0.2cm'> <span class='enc'>La Plata No. 6254 <br> entre Sucre y Murguia Frente Cine Hollywood</span><br>
        <img  src='img/correo.jpg' style='width:0.2cm;height:0.2cm'><span class='enc'> gonzalesdelcastillomarcelo@hotmail.com </span><br>
        <img  src='img/telf.png' style='width:0.2cm;height:0.2cm'> <span class='enc'>Cel: 78611101</span>
        </td>
        <td><h2><b>RECIBO</b></h2></td>
        <td>
            <b>Bs. : </b>".$ing->monto."<br>
            <span style='color:red'><b>No</b> $string</span>
        </td>
        </tr>
        <tr>
        <td colspan=4>
            <b> He recibido del Sr. (a): </b>".$cl[0]->nombre."
            <br>
            <b> La suma de : </b>". $formatter->toWords($ing->monto)."  Bolivianos.
            <br>
            <b> Por concepto de: </b>".$tr[0]->nombre."<br>
            
        </td>
        <tr>
        <tr>
        <td><b> Efectivo:</b> X </td>
        <td><b> Cheque N:</b></td>
        <td><b> Banco: </b></td>
        <td><b> T/C:</b></td>
        </tr>
        <tr>
        <td colspan=2 style='text-align:justify; '><b> Total :</b></td>
        <td  style='text-align:justify;' ><b> A cuenta: </b></td>
        <td  style='text-align:justify; '><b> Saldo:</b></td>
        
        </tr>
        <tr>
        <td colspan=4 style='text-align:center; width:100%'> 
        Oruro, ".date("d", strtotime($ing->fecha))." de ".$mes[intval(date("m", strtotime($ing->fecha))) - 1]." de ". date("Y", strtotime($ing->fecha))."
        <td>
        </tr>
        <tr>
        <td colspan=2 class='nom' style='text-align:center; width:50%'>Marcelo J. Gonzales Del Castillo</td>
        <td colspan=2 style='text-align:center; width:50%'></td>
        </tr>
        <tr>
        <td colspan=2 style='text-align:center;  width:50%'><b>RECIBI CONFORME</b></td>
        <td colspan=2 style='text-align:center; width:50% '><b>ENTREGUE CONFORME</b></td>
        </tr>
        
        </table>
        </td></tr></table>
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
