<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;
    public function detalleproformas(){
        return $this->hasMany(Detalleproforma::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
