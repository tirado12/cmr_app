<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicitacionInvitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licitacion_invitacion', function (Blueprint $table) {
            $table->id('id_licitacion_invitacion');
            $table->integer('bases_licitacion')->default('2');
            $table->integer('constancia_visita')->default('2');
            $table->integer('acta_junta_aclaraciones')->default('2');
            $table->integer('acta_apertura_tecnica')->default('2');
            $table->integer('dictamen_tecnico')->default('2');
            $table->integer('acta_apertura_economica')->default('2');
            $table->integer('dictamen_economico')->default('2');
            $table->integer('dictamen')->default('2');
            $table->integer('acta_fallo')->default('2');
            $table->integer('propuesta_licitantes_economica')->default('2');
            $table->integer('propuesta_licitantes_tecnica')->default('2');
            $table->unsignedBigInteger('obra_contrato_id');
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
        Schema::dropIfExists('licitacion_invitacion');
    }
}
