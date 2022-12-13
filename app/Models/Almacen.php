<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $table = "almacenes";

    protected $fillable = [
        'id',
        'cadena_comercial_id',
        'alimentos_id'
    ];

    public $timestamps = false;

    public function cadenaComercial()
    {
        return $this->belongsTo(CadenaComercial::class);
    }

    public function alimentos()
    {
        return $this->belongsTo(Alimentos::class);
    }
}
