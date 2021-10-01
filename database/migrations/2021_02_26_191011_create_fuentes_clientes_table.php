<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuentesClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuentes_clientes', function (Blueprint $table) {
            $table->id('id_fuente_financ_cliente');
            $table->double('monto_proyectado');
            $table->double('monto_comprometido');
            $table->string('ejercicio', 4);
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id_cliente')->on('clientes');
            $table->unsignedBigInteger('fuente_financiamiento_id');
            $table->foreign('fuente_financiamiento_id')->references('id_fuente_financiamiento')->on('fuentes_financiamientos');
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
        Schema::dropIfExists('fuentes_clientes');
    }
}
