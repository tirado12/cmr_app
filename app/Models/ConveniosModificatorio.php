<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConveniosModificatorio extends Model
{
    use HasFactory;
    
    protected $table = "convenios_modificatorios";
    protected $primaryKey = 'id_convenio_modificatorio';

    protected $fillable = [
        'numero_convenio_modificatorio',
        'fecha_convenio',
        'tipo',
        'monto_modificado',
        'fecha_fin_modificada',
        'obra_contrato_id',
        'agregado_expediente'
    ];
}
