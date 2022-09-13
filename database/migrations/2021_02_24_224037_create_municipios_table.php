<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->id('id_municipio');
            $table->string('nombre', 100);
            $table->string('rfc', 13)->nullable()->unique();
            $table->string ('direccion')->nullable();            
            $table->unsignedBigInteger('distrito_id');
            $table->foreign('distrito_id')->references('id_distrito')->on('distritos');
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
        Schema::dropIfExists('municipios');
    }
}
