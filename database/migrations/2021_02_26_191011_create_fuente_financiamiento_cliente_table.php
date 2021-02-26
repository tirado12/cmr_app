<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuenteFinanciamientoClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuente_financiamiento_cliente', function (Blueprint $table) {
            $table->id('id_fuente_financ_cliente');
            $table->integer('monto_proyectado');
            $table->integer('monto_comprometido');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id_cliente')->on('cliente');
            $table->unsignedBigInteger('fuente_financiamiento_id');
            $table->foreign('fuente_financiamiento_id')->references('clave')->on('fuente_financiamiento');
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
        Schema::dropIfExists('fuente_financiamiento_cliente');
    }
}
