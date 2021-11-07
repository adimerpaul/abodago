<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'despacho_id',
        "concepto",
        "monto",
        "fecha",
        "hora",
    ];
    
}
