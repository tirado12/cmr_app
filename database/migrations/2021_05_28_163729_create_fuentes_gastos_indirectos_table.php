<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuentesGastosIndirectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuentes_gastos_indirectos', function (Blueprint $table) {
            $table->id('id_fuentes_gastos_indirectos');
            $table->unsignedBigInteger('indirectos_id');
            $table->foreign('indirectos_id')->references('id_indirectos')->on('gastos_indirectos');
            $table->unsignedBigInteger('fuente_cliente_id')->nullable();
            $table->foreign('fuente_cliente_id')->references('id_fuente_financ_cliente')->on('fuentes_clientes');
            $table->double('monto')->nullable();
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
        Schema::dropIfExists('fuentes_gastos_indirectos');
    }
}
