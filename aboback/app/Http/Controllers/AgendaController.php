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

    public function agendar(Request $request)
    {
        return $request;
        $agenda=new Agenda();
        $agenda->estado='AGENDAR';
        $agenda->actividad=$request->actividad;
        $agenda->proximopaso=$request->actividad;
        $agenda->fechaini=$request->fecha;
        $agenda->horaini=$request->hora;
        $agenda->fechafin=$request->fecha;
        $agenda->horafin=$request->hora;
        $agenda->user_id=$request->usuario_id==0?$request->user()->id:$request->usuario_id;
        $agenda->save();
        return $agenda;
    }

    public function listagenda(Request $request)
    {
        $year=date("Y",strtotime($request->fecha));
        $mes=date("m",strtotime($request->fecha));
        if($request->user()->id==1 || $request->user()->id==2)
        return Agenda::with('user')->with('despacho')->with('etapa')->orderBy('estado','asc')->get();
        return Agenda::where('user_id',$request->user()->id)
        ->with('user')->with('despacho')->with('etapa')->orderBy('estado','asc')->get();
    }

    public function updagenda(Request $request){
        $agenda= Agenda::find($request->id);
        $agenda->actividad=$request->actividad;
        $agenda->proximopaso=$request->actividad;
        $agenda->user_id=$request->usuario_id;
        $agenda->save();
        return $agenda;
    }

    public function delagenda(Request $request){
        $agenda= Agenda::find($request->id);
        return $agenda->delete();
    }

    public function evagenda($id)
    {
        return Agenda::where('id',$id)
            ->with('user')
            ->with('despacho')
            ->with('etapa')
            ->get();
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
        $agenda->user_id=$request->user_id;
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
        return Agenda::with('user')->with('userterminado')->with('etapa')->where('despacho_id',$despacho_id)->get();
    }

    public function finalizar(Request $request){
        $agenda=Agenda::find($request->id);
        $agenda->estado='TERMINADO';
        $agenda->fechaterminado=date('Y-m-d');
        $agenda->horaterminado=date('H:i:s');
        $agenda->userterminado_id=$request->user()->id;
        $agenda->save();

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
