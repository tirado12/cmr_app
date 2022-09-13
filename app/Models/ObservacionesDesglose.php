<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservacionesDesglose extends Model
{
    use HasFactory;
    protected $table = "observaciones_desglose";
    protected $primaryKey = 'id_observaciones_desglose';

    protected $fillable = [
        'fecha_observaciones',
        'fecha_solventacion',
        'desglose_pagos_id',
    ];
}
