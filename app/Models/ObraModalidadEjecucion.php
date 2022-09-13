<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraModalidadEjecucion extends Model
{
    use HasFactory;

    protected $table = "obra_modalidad_ejecucion";

    protected $fillable = [
        'obra_id',
        'obra_administracion_id',
        'parte_social_tecnica_id',
        'obra_contrato'
    ];
}