<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoListaRaya extends Model
{
    use HasFactory;
    


    protected $table = "contrato_lista_raya";
    protected $primaryKey = 'id_lista_raya';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'total',
        'numero_lista_raya',
        'isr',
        'mano_obra',
        'obra_administracion_id',
        'agregado_expediente'
    ];
}
