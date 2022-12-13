<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;
    protected $table = "convenios";

    protected $fillable = [
        'id',
        'municipio_id',
        'cadena_comercial_id'
    ];

    public $timestamps = false;

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function cadenaComercial()
    {
        return $this->belongsTo(CadenaComercial::class);
    }
}
