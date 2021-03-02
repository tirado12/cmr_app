<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosModificatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenios_modificatorios', function (Blueprint $table) {
            $table->string('numero_convenio_modificatorio')->nullable();
            $table->date('fecha_convenio')->nullable();
            $table->integer('tipo')->nullable();
            $table->double('monto_modificado')->nullable();
            $table->double('fehca_fin_modificada')->nullable();
            $table->unsignedBigInteger('obra_contrato_id')->nullable();
            $table->foreign('obra_contrato_id')->references('id_obra_contrato')->on('obras_contrato');
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
        Schema::dropIfExists('convenios_modificatorios');
    }
}
