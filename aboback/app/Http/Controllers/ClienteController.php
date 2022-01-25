<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
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
        return Cliente::with('despachos')->get();
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
        $cliente->tipo=$request->tipo;
        $cliente->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    public function regreso($id){
        return db::select("select fecha,hora,monto,'' as recibo, concepto,'EGRESO' as tipo from egresos where despacho_id= $id");
    }

    public function ringreso($id){
        return db::select("select fecha, hora, monto, recibo,'' as concepto,'INGRESO' as tipo from ingresos where despacho_id= $id");
    }

    public function regotro($id){
        return db::select("select fecha,hora,monto,'' as recibo, concepto,'EGCLIENTE' as tipo from egotros where despacho_id= $id");
    }


}
