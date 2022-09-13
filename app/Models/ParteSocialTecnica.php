<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParteSocialTecnica extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_parte_social_tecnica';

    protected $table = "parte_social_tecnica";

    protected $fillable = [
        'acta_integracion_consejo',
        'acta_seleccion_obras',
        'acta_priorizacion_obras',
        'convenio_mezcla',
        'acta_integracion_comite',
        'convenio_concertacion',
        'acta_aprobacion_obra',
        'acta_excep_licitacion',
        'estudio_factibilidad',
        'oficio_aprovacion_obra',
        'anexos_oficio_notificacion',
        'cedula_informacion_basica',
        'generalidades_inversion',
        'tenencia_tierra',
        'dictamen_impacto_ambiental',
        'presupuesto_obra',
        'generadores_obra',
        'planos_proyecto',
        'especificaciones_generales_particulares',
        'dro',
        'programa_obra_inversion',
        'croquis_macro',
        'croquis_micro',
    ];
}
