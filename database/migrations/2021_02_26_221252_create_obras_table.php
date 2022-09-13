<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id('id_obra');
            $table->string('numero_obra')->nullable();
            $table->text('nombre_obra')->nullable();
            $table->text('nombre_corto')->nullable();
            $table->text('nombre_archivo')->nullable();
            $table->string('oficio_notificacion')->nullable();
            $table->date('fecha_oficio_notificacion')->nullable();
            $table->double('monto_contratado')->nullable();
            $table->double('monto_modificado')->nullable();
            $table->date('fecha_inicio_programada')->nullable();
            $table->date('fecha_final_programada')->nullable();
            $table->date('fecha_inicio_real')->nullable();
            $table->date('fecha_final_real')->nullable();
            $table->date('fecha_actualizacion')->nullable();
            $table->boolean('modalidad_ejecucion')->nullable();
            $table->string('situacion')->nullable();
            $table->double('avance_fisico')->nullable();
            $table->double('avance_tecnico')->nullable();
            $table->double('avance_economico')->nullable();
            $table->integer('anticipo_porcentaje')->nullable();
            $table->double('anticipo_monto')->nullable();
            $table->date('acta_seleccion_obras')->nullable();
            $table->date('convenio_colaboracion_instancias')->nullable();
            $table->date('acta_intregracion_comite')->nullable();
            $table->date('convenio_concertacion')->nullable();
            $table->date('acta_aprobacion_autorizacion')->nullable();
            $table->date('acta_excepcion_licitacion')->nullable();
            $table->text('nombre_localidad')->nullable();
            $table->text('tipo_localidad')->nullable();
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
        Schema::dropIfExists('obras');
    }
}
