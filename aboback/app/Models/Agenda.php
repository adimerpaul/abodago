<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable=[
        'etapa',
        'estado',
        'actividad',
        'proximopaso',
        'fechaini',
        'horaini',
        'fechafin',
        'horafin',
        'user_id',
        'despacho_id',
    ];

    public function usuario(){
        return $this->belongsTo(User::class);
    }

    public function despacho(){
        return $this->belongsTo(Despacho::class);
    }
}

