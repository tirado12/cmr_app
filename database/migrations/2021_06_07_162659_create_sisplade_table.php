<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSispladeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisplade', function (Blueprint $table) {
            $table->id('id_sisplade');
            $table->unsignedBiginteger('fuentes_clientes_id')->nullable();
            $table->foreign('fuentes_clientes_id')
                    ->references('id_fuente_financ_cliente')
                    ->on('fuentes_clientes');
            $table->integer('capturado')->default('2');
            $table->date('fecha_capturado')->nullable();
            $table->integer('validado')->default('2');
            $table->date('fecha_validado')->nullable();
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
        Schema::dropIfExists('sisplade');
    }
}
