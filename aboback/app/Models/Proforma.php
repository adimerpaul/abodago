<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;

    protected $fillable=[
    "total",
    "fecha",
    "cliente_id",
    "tramite_id",
    ];

    public function detalleproformas(){
        return $this->hasMany(Detalleproforma::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function tramite(){
        return $this->belongsTo(Tramite::class);
    }
}
