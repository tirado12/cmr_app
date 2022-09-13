<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParteSocialTecnicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parte_social_tecnica', function (Blueprint $table) {
            $table->id('id_parte_social_tecnica');
            $table->integer('acta_integracion_consejo')->default('2');
            $table->integer('acta_seleccion_obras')->default('2');
            $table->integer('acta_priorizacion_obras')->default('2');
            $table->integer('convenio_mezcla')->default('2');
            $table->integer('acta_integracion_comite')->default('2');
            $table->integer('convenio_concertacion')->default('2');
            $table->integer('acta_aprobacion_obra')->default('2');
            $table->integer('acta_excep_licitacion')->default('2');
            $table->integer('acta_ejecutar_adjudicacion')->default('2');
            $table->integer('estudio_factibilidad')->default('2');
            $table->integer('oficio_aprobacion_obra')->default('2');
            $table->integer('anexos_oficio_notificacion')->default('2');
            $table->integer('cedula_informacion_basica')->default('2');
            $table->integer('generalidades_inversion')->default('2');
            $table->integer('tenencia_tierra')->default('2');
            $table->integer('dictamen_impacto_ambiental')->default('2');
            $table->integer('presupuesto_obra')->default('2');
            $table->integer('catalogo_conceptos')->default('2');
            $table->integer('explosion_insumos')->default('2');
            $table->integer('generadores_obra')->default('2');
            $table->integer('planos_proyecto')->default('2');
            $table->integer('especificaciones_generales_particulares')->default('2');
            $table->integer('dro')->default('2');
            $table->integer('programa_obra_inversion')->default('2');
            $table->integer('croquis_macro')->default('2');
            $table->integer('croquis_micro')->default('2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parte_social_tecnica');
    }
}
