<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasAdministracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras_administracion', function (Blueprint $table) {
            $table->id('id_obra_administracion');
            $table->integer('inventario_maquinaria_construccion')->default('2');
            $table->integer('plantilla_personal')->default('2');
            $table->integer('indentificacion_oficial_trabajadores')->default('2');
            $table->integer('reporte_fotografico')->default('2');
            $table->integer('notas_bitacora')->default('2');
            $table->integer('acta_entrega_municipio')->default('2');
            $table->integer('cedula_detallada_facturacion')->default('2');
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
        Schema::dropIfExists('obras_administracion');
    }
}
