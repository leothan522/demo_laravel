<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pedidos_id')->unsigned();
            $table->bigInteger('cuentas_id')->unsigned();
            $table->string('referencia')->nullable();
            $table->decimal('monto', 12, 2)->nullable();
            $table->string('capture')->nullable();
            $table->integer('estatus')->default(0);
            $table->string('tipo');
            $table->bigInteger('reembolsos_id')->nullable();
            $table->bigInteger('users_id');
            $table->softDeletes();
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
        Schema::dropIfExists('movimientos');
    }
}
