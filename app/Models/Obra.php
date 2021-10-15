<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_obra';
    protected $table = "obras";

    protected $fillable = [
        'numero_obra',
        'nombre_obra',
        'nombre_corto',
        'nombre_archivo',
        'numero_contrato',
        'oficio_notificacion',
        'monto_contratado',
        'monto_modificado',
        'fecha_contrato',
        'fecha_inicio_programada',
        'fecha_final_programada',
        'fecha_inicio_real',
        'fecha_final_real',
        'modalidad_ejecucion',
        'situacion',
        'avance_fisico',
        'avance_tecnico',
        'avance_economico',
        'anticipo_porcentaje',
        'acta_seleccion_obras',
        'convenio_colaboracion_instancias',
        'acta_integracion_comite',
        'convenio_concertacion',
        'acta_aprobacion_autorizacion',
        'acta_excepcion_licitacion',
        'fuente_financiamiento_cliente_id'
    ];

    public function fuentesCliente(){
        return $this->hasMany(FuentesCliente::class,'obras_fuente.obra_id','id_obra');
    }
}
