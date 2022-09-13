<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObrasContrato extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_obra_contrato';

    protected $table = "obras_contrato";

    protected $fillable = [
        "numero_contrato",
        "fecha_contrato",
        "contrato",
        "contrato_tipo",
        "oficio_justificativo_convenio_modificatorio",
        "analisis_p_u",
        "catalogo_conceptos",
        "montos_mensuales_ejecutados",
        "calendario_trabajos_ejecutados",
        "oficio_superintendente",
        "oficio_residente_obra",
        "oficio_disposicion_inmueble",
        "oficio_inicio_obra",
        "factura_anticipo",
        "exp_factura_anticipo",
        "fianza_anticipo",
        "exp_fianza_anticipo",
        "fianza_cumplimiento",
        "exp_fianza_cumplimiento",
        "fianza_v_o",
        "exp_fianza_v_o",
        "presupuesto_definitivo",
        "aviso_terminacion_obra",
        "acta_entrega_contratista",
        "acta_entrega_municipio",
        "saba_finiquito",
        "acta_extincion",
        "modalidad_asignacion",
        "contratista_id",
    ];
}
