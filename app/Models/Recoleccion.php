<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recoleccion extends Model
{
    use HasFactory;

    protected $table = "recolecciones";

    protected $fillable = [
        'id',
        'usuario_id',
        'almacen_id'
    ];

    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }
}
