<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecoleccionAlimentos extends Model
{
    use HasFactory;

    protected $table = "recoleccion_alimentos";

    protected $fillable = [
        'id',
        'recoleccion_id',
        'alimento_id',
        'comentarios',
        'foto'
    ];

    public function recoleccion()
    {
        return $this->belongsTo(Recoleccion::class);
    }

    public function alimento()
    {
        return $this->belongsTo(Alimento::class);
    }
}
