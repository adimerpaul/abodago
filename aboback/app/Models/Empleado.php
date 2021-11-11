<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable=[
        'ci',
        'nombre',
        'cargo',
        'salario',
        'fechaing',
        'dias',
        'celular'
    ];
    public function sueldos(){
        return $this->hasMany(Sueldo::class);
    }
}
