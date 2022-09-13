<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosArrendamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_arrendamientos', function (Blueprint $table) {
            $table->id('id_contrato_arrendamiento');
            $table->string('numero_contrato');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->date('fecha_contrato');
            $table->double('monto_contratado');
            $table->integer('agregado_expediente')->nullable();
            $table->unsignedBigInteger('obra_administracion_id');
            $table->foreign('obra_administracion_id')->references('id_obra_administracion')->on('obras_administracion');
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id_proveedor')->on('proveedores');
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
        Schema::dropIfExists('contratos_arrendamientos');
    }
}
