<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoListaRayaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_lista_raya', function (Blueprint $table) {
            $table->id('id_lista_raya');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->double('total');
            $table->integer('numero_lista_raya');
            $table->double('isr');
            $table->double('mano_obra');
            $table->integer('agregado_expediente')->nullable();
            $table->unsignedBigInteger('obra_administracion_id');
            $table->foreign('obra_administracion_id')->references('id_obra_administracion')->on('obras_administracion');
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
        Schema::dropIfExists('contrato_lista_raya');
    }
}
