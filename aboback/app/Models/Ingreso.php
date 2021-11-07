<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $fillable=[
    'user_id',
    'despacho_id',
    "recibo",
    "monto",
    "fecha",
    "hora",
];

}
