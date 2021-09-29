
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesglosePagosObra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desglose_pagos_obra', function (Blueprint $table) {
            $table->id('id_desglose_pagos');
            $table->unsignedBiginteger('obra_contrato_id')->nullable();
            $table->foreign('obra_contrato_id')
                    ->references('id_obra_contrato')
                    ->on('obras_contrato');
            $table->date('fecha_recepcion')->nullable();
            $table->date('fecha_validacion')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('archivo_nombre')->nullable();
            $table->string('nombre')->nullable();
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
        Schema::dropIfExists('desglose_pagos_obra');
    }
}
