<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexosFondo3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos_fondo3', function (Blueprint $table) {
            $table->id('id_anexos_fondo3');
            $table->date('acta_integracion_consejo')->nullable();
            $table->date('acta_priorizacion')->nullable();
            $table->date('adendum_priorizacion')->nullable();
            $table->boolean('prodim')->nullable();
            $table->boolean('gastos_indirectos')->nullable();
            $table->double('porcentaje_prodim')->nullable();
            $table->double('porcentaje_gastos')->nullable();
            $table->double('monto_prodim')->nullable();
            $table->double('monto_gastos')->nullable();
            $table->unsignedBigInteger('fuente_financiamiento_cliente_id')->nullable();
            $table->foreign('fuente_financiamiento_cliente_id')->references('id_fuente_financ_cliente')->on('fuentes_clientes');
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
        Schema::dropIfExists('anexos_fondo3');
    }
}
