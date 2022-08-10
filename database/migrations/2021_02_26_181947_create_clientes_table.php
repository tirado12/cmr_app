<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('user')->unique();
            $table->string('email')->unique();
            $table->text('password');
            $table->rememberToken()->nullable();
            $table->date('anio_inicio');
            $table->date('anio_fin');
            $table->text('logo', 255)->nullable();
            $table->string('url',100)->nullable();
            $table->string('id_onesignal',150)->nullable();
            
            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')->references('id_municipio')->on('municipios');
            
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
        Schema::dropIfExists('clientes');
    }
}
