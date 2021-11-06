<?php

namespace App\Http\Controllers;

use App\Models\Despacho;
use Illuminate\Http\Request;

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
}
