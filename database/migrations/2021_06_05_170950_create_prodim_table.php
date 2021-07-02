<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodim', function (Blueprint $table) {
            $table->id('id_prodim');
            $table->integer('firma_electronica')->nullable();
            $table->integer('revisado')->nullable();
            $table->date('fecha_revisado')->nullable();
            $table->integer('validado')->nullable();
            $table->date('fecha_validado')->nullable();
            $table->integer('convenio')->nullable();
            $table->date('fecha_convenio')->nullable();
            $table->text('acuse_prodim')->nullable();
            $table->unsignedBiginteger('fuente_id')->nullable();
            $table->foreign('fuente_id')->references('id_fuente_financ_cliente')->on('fuentes_clientes');
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
        Schema::dropIfExists('prodim');
    }
}
