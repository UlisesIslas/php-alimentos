<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;

    protected $table = "alimentos";

    protected $fillable = [
        'id',
        'nombre',
        'categoria_alimentos_id'
    ];

    public $timestamps = false;

    public function categoriaAlimentos()
    {
        return $this->belongsTo(CategoriaAlimentos::class);
    }
}
