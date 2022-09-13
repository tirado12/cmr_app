<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFechasRftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas_rft', function (Blueprint $table) {
            $table->id('id_fechas_rft');
            $table->string('fecha_primer_trimestre');
            $table->string('fecha_segundo_trimestre');
            $table->string('fecha_tercer_trimestre');
            $table->string('fecha_cuarto_trimestre');
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
        Schema::dropIfExists('fechas_rft');
    }
}
