<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratistas', function (Blueprint $table) {
            $table->id('id_contratista');
            $table->string('rfc',13)->unique();
            $table->boolean('tipo_rfc');
            $table->text('razon_social');
            $table->string('representante_legal')->nullable();
            $table->text('domicilio')->nullable();
            $table->string('telefono',13)->nullable();
            $table->string('correo',255)->nullable();
            $table->string('numero_padron_contratista')->nullable();
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
        Schema::dropIfExists('contratistas');
    }
}
