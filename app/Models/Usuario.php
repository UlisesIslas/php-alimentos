<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    
    protected $table = "usuarios";

    protected $fillable = [
        'id',
        'correo',
        'password',
        'nombre',
        'apellido1',
        'apellido2',
        'status',
        'municipio_id'
    ];

    public $timestamps = false;
}
