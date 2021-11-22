<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    use HasFactory;
    protected $fillable=[
        "fecha",
        "hora",
        "tipo",
        "juzgado",
        "webid",
        "nurej",
        "proceso",
        "demandante",
        "ci",
        "representante",
        'tramite_id',
        'cliente_id',
    ];
    public function requisitos(){
        return $this->belongsToMany(Requisito::class);
    }
    public function demandados(){
        return $this->belongsToMany(Demandado::class);
    }
}
