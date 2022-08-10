<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rft', function (Blueprint $table) {
            $table->id('id_rft');
            $table->unsignedBiginteger('obra_id')->nullable();
            $table->foreign('obra_id')
                    ->references('id_obra')
                    ->on('obras');
            $table->integer('primer_trimestre')->nullable();
            $table->integer('segundo_trimestre')->nullable();
            $table->integer('tercer_trimestre')->nullable();
            $table->integer('cuarto_trimestre')->nullable(); 
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
        Schema::dropIfExists('rft');
    }
}