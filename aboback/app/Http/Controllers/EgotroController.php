<?php

namespace App\Http\Controllers;

use App\Models\Egotro;
use Illuminate\Http\Request;

class EgotroController extends Controller
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
        $egotro=new Egotro;
        $egotro->user_id=$request->user()->id;
        $egotro->despacho_id=$request->despacho_id;
        $egotro->concepto=$request->concepto;
        $egotro->monto=$request->monto;
        $egotro->fecha=$request->fecha;
        $egotro->hora=$request->hora;
        $egotro->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Egotro  $egotro
     * @return \Illuminate\Http\Response
     */
    public function show(Egotro $egotro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Egotro  $egotro
     * @return \Illuminate\Http\Response
     */
    public function edit(Egotro $egotro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Egotro  $egotro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Egotro $egotro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Egotro  $egotro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Egotro $egotro)
    {
        //
    }
}
