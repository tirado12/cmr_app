<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimaciones', function (Blueprint $table) {
            $table->id('id_estimacion');
            $table->integer('numero_estimacion')->nullable();
            $table->double('total_estimacion')->nullable();
            $table->double('supervicion_obra')->nullable();
            $table->double('mano_obra')->nullable();
            $table->double('cinco_millar')->nullable();
            $table->double('dos_millar')->nullable();
            $table->double('amortizacion_anticipo')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_final')->nullable();
            $table->date('fecha_estimacion')->nullable();
            $table->string('folio_factura',36)->nullable();
            $table->boolean('finiquito')->nullable();
            $table->integer('factura_estimacion')->default('2');
            $table->integer('caratula_estimacion')->default('2');
            $table->integer('presupuesto_estimacion')->default('2');
            $table->integer('cuerpo_estimacion')->default('2');
            $table->integer('numero_generadores_estimacion')->default('2');
            $table->integer('resumen_estimacion')->default('2');
            $table->integer('estado_cuenta_estimacion')->default('2');
            $table->integer('croquis_ilustrativo_estimacion')->default('2');
            $table->integer('reporte_fotografico_estimacion')->default('2');
            $table->integer('notas_bitacora')->default('2');
            $table->unsignedBigInteger('desglose_pagos_id')->nullable();
            $table->foreign('desglose_pagos_id')->references('id_desglose_pagos')->on('desglose_pagos_obra');
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
        Schema::dropIfExists('estimaciones');
    }
}
