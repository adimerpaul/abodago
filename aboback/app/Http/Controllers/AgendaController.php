<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
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

    public function listagenda(Request $request)
    {
        return Agenda::where('user_id', $request->user()->id)->where('estado', 'ACTIVO')->with('usuario')->with('despacho')->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function etapas()
    {
        return DB::SELECT('SELECT etapa from agendas group by etapa');
    }
    public function store(Request $request)
    {
//        return $request;
        $agenda=new Agenda();
        $agenda->etapa_id=$request->etapa_id;
        $agenda->estado='EN ESPERA';
        $agenda->actividad=$request->actividad;
        $agenda->proximopaso=$request->proximopaso;
        $agenda->fechaini=date('Y-m-d');
        $agenda->horaini=date('H:i:s');
        $agenda->fechafin=$request->fechafin;
        $agenda->horafin=$request->horafin;
        $agenda->user_id=$request->user()->id;
        $agenda->despacho_id=$request->despacho_id;
        $agenda->save();
        return $agenda;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show($despacho_id)
    {
        return Agenda::with('user')->with('etapa')->where('despacho_id',$despacho_id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        //
    }
}
