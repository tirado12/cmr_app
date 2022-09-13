<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexosFondoIII extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_anexos_fondo3';
    protected $table = "anexos_fondo3";

    protected $fillable=[
        'acta_integracion_consejo',
        'acta_priorizacion',
        'adendum_priorizacion',
        'prodim',
        'gastos_indirectos',
        'fuente_financiamiento_cliente_id',
        'porcentaje_prodim',
        'monto_prodim',
        'porcentaje_gastos',
        'monto_gastos',
    ];

}
