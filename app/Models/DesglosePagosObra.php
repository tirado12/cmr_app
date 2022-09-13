<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesglosePagosObra extends Model
{
    use HasFactory;
    protected $table = "desglose_pagos_obra";
    protected $primaryKey = 'id_desglose_pagos';

    protected $fillable = [
        'fecha_recepcion',
        'fecha_validacion',
        'fecha_pago',
        'archivo_nombre',
        'nombre',
        'obra_contrato_id'
    ];

    public function observaciones(){
        return $this->hasMany(FuentesCliente::class, 'id_fuente_financ_cliente', 'fuente_financiamiento_cliente_id'); //arg1 - Model, arg2 - foreign key
    }
}
