<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BancoAlimentos extends Model
{
    use HasFactory;

    protected $table = "banco_alimentos";

    protected $fillable = [
        'id',
        'nombre',
        'municipio_id'
    ];

    public $timestamps = false;

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

}
