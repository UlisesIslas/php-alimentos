<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaAlimento extends Model
{
    use HasFactory;

    protected $table = "categorias_alimentos";

    protected $fillable = [
        'id',
        'nombre'
    ];

    public $timestamps = false;
}
