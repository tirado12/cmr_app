<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprometidoDesgloseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprometido_desglose', function (Blueprint $table) {
            $table->id('id_desglose');
            $table->unsignedBiginteger('comprometido_id')->nullable();
            $table->foreign('comprometido_id')
                    ->references('id_comprometido')
                    ->on('prodim_comprometido');
            $table->string('concepto')->nullable();
            $table->double('monto_desglose')->nullable();
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
        Schema::dropIfExists('comprometido_desglose');
    }
}
