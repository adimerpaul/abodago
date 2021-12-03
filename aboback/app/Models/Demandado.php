<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandado extends Model
{
    use HasFactory;
    protected $fillable=[
        'ci',
        'nombre',
    ];

    public function despachos(){
        return $this->belongsToMany(Despacho::class)->with('tramite');
        
    }
}
