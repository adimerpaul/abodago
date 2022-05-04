<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Despacho;
use App\Models\Proforma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::with('despachos')->orderBy('nombre','asc')->get();
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
//        return  $request;
        $nombreArchivo='';
        if ($request->hasFile('imagen')) {
//            return "si";
            $file=$request->file('imagen');
            $nombreArchivo = time().".".$file->getClientOriginalExtension();
//        return $nombreArchivo;
            $file->move(\public_path('imagenes'), $nombreArchivo);
//            return $nombreArchivo;
//            $request->imagen=$nombreArchivo;
        }
//        return $request;
//        Cliente::create($request->all());
        $cliente= new Cliente();
        $cliente->ci=$request->ci;
        $cliente->nombre= strtoupper( $request->nombre);
        $cliente->telefono=!isset($request->telefono)?NULL:$request->telefono;
        $cliente->tipo=$request->tipo;
        $cliente->imagen=$nombreArchivo;
        $cliente->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */

     public function clienteimg(Request $request){
         $cliente=Cliente::find($request->id);
        $nombreArchivo='';
        if ($request->hasFile('imagen')) {
//            return "si";
            $file=$request->file('imagen');
            $nombreArchivo = time().".".$file->getClientOriginalExtension();
//        return $nombreArchivo;
            $file->move(\public_path('imagenes'), $nombreArchivo);
//            return $nombreArchivo;
//            $request->imagen=$nombreArchivo;
        }
//        return $request;
//        Cliente::create($request->all());
        $cliente->imagen=$nombreArchivo;
        $cliente->save();
     }

    public function show(Cliente $cliente)
    {
        //        $nombreArchivo='';

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente=Cliente::find($id);
        $cliente->ci=$request->ci;
        $cliente->nombre= strtoupper( $request->nombre);
        $cliente->telefono=!isset($request->telefono)?NULL:$request->telefono;
        $cliente->tipo=$request->tipo;
        $cliente->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente=cliente::find($id);
        $despacho=Despacho::where('cliente_id',$id)->get();
        $proforma=Proforma::where('cliente_id',$id)->get();
        foreach ($proforma as $d) {
            DB::SELECT("DELETE from detalleproformas where proforma_id=$d->id");
            $prof=Proforma::find($d->id);
            $prof->delete();            
        }
        foreach ($despacho as $r) {
            DB::SELECT("DELETE from agendas where despacho_id=$r->id");
            DB::SELECT("DELETE from egotros where despacho_id=$r->id");
            DB::SELECT("DELETE from egresos where despacho_id=$r->id");
            DB::SELECT("DELETE from ingresos where despacho_id=$r->id");
            DB::SELECT("DELETE from demandado_despacho where despacho_id=$r->id");
            DB::SELECT("DELETE from despacho_requisito where despacho_id=$r->id");
            $despacho=Despacho::find($r->id);
            $despacho->delete();
        }

        $cliente->delete();

    }

    public function regreso($id){
        return db::select("select id,fecha,hora,monto,'' as recibo, concepto,'EGRESO' as tipo from egresos where despacho_id= $id");
    }

    public function ringreso($id){
        return db::select("select id,fecha, hora, monto, recibo,motivo as concepto,'INGRESO' as tipo from ingresos where despacho_id= $id");
    }

    public function regotro($id){
        return db::select("select id,fecha,hora,monto,'' as recibo, concepto,'EGCLIENTE' as tipo from egotros where despacho_id= $id");
    }

    public function reporte(Request $request){
        return DB::SELECT("SELECT *, 
        (select sum(monto) from clientes c INNER join despachos d on c.id=d.cliente_id inner join ingresos i on d.id=i.despacho_id where c.id=c1.id and i.fecha>='$request->fecha1' and i.fecha<='$request->fecha2') as ingreso,
        (select sum(monto) from clientes c INNER join despachos d on c.id=d.cliente_id inner join egresos e on d.id=e.despacho_id where c.id=c1.id and e.fecha>='$request->fecha1' and e.fecha<='$request->fecha2') as egreso,
        (select sum(monto) from clientes c INNER join despachos d on c.id=d.cliente_id inner join egotros o on d.id=o.despacho_id where c.id=c1.id and o.fecha>='$request->fecha1' and o.fecha<='$request->fecha2') as egotro
         from clientes c1;");
    }

}
