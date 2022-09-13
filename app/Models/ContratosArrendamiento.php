<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratosArrendamiento extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_contrato_arrendamiento';
    protected $table = "contratos_arrendamientos";

    protected $fillable = [
        'id_contrato_arrendamiento',
        'numero_contrato',
        'fecha_inicio',
        'fecha_fin',
        'fecha_contrato',
        'monto_contratado',
        'obra_administracion_id',
        'proveedor_id'
    ];
}
