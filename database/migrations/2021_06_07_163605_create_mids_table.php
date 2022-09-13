 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mids', function (Blueprint $table) {
            $table->id('id_mids');
            $table->unsignedBiginteger('obra_id')->nullable();
            $table->foreign('obra_id')
                    ->references('id_obra')
                    ->on('obras');
            $table->integer('planeado')->default('2');
            $table->date('fecha_planeado')->nullable();
            $table->integer('firmado')->default('2');
            $table->date('fecha_firmado')->nullable();
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
        Schema::dropIfExists('mids');
    }
}
