<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateObrasContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras_contrato', function (Blueprint $table) {
            $table->id('id_obra_contrato');
            $table->string('numero_contrato')->nullable();
            $table->date('fecha_contrato')->nullable();
            $table->integer('contrato')->default('2');
            $table->integer('contrato_tipo')->nullable();
            $table->integer('oficio_justificativo_convenio_modificatorio')->nullable();
            $table->integer('analisis_p_u')->default('2');
            $table->integer('catalogo_conceptos')->default('2');
            $table->integer('montos_mensuales_ejecutados')->default('2');
            $table->integer('calendario_trabajos_ejecutados')->default('2');
            $table->integer('oficio_superintendente')->default('2');
            $table->integer('oficio_residente_obra')->default('2');
            $table->integer('oficio_disposicion_inmueble')->default('2');
            $table->integer('oficio_inicio_obra')->default('2');
            $table->string('factura_anticipo')->nullable();
            $table->integer('exp_factura_anticipo')->default('2');
            $table->string('fianza_anticipo')->nullable();
            $table->integer('exp_fianza_anticipo')->default('2');
            $table->string('fianza_cumplimiento')->nullable();
            $table->integer('exp_fianza_cumplimiento')->default('2');
            $table->string('fianza_v_o')->nullable();
            $table->integer('exp_fianza_v_o')->default('2');
            $table->integer('presupuesto_definitivo')->default('2');
            $table->integer('aviso_terminacion_obra')->default('2');
            $table->integer('acta_entrega_contratista')->default('2');
            $table->integer('acta_entrega_municipio')->default('2');
            $table->integer('saba_finiquito')->default('2');
            $table->integer('acta_extincion')->default('2');
            $table->integer('padron_contratistas')->default('2'); 
            $table->integer('invitacion_acuse_recepcion')->default('2'); 
            $table->integer('aceptacion_invitacion')->default('2'); 
            $table->integer('modalidad_asignacion')->nullable();
            $table->unsignedBigInteger('contratista_id')->nullable();
            $table->foreign('contratista_id')->references('id_contratista')->on('contratistas');
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
        Schema::dropIfExists('obras_contrato');
    }
}
