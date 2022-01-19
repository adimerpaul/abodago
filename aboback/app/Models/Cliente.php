<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable=[
        'ci',
        'nombre',
        'tipo',
        'imagen',
    ];
    public function despachos(){
        return $this->hasMany(Despacho::class)->with('tramite');
    }
}
