<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('total', 12, 2);
            $table->text('nota_cliente')->nullable();
            $table->integer('estatus')->default(0);
            $table->date('fecha');
            $table->string('cedula');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('telefono');
            $table->text('direccion_1');
            $table->text('direccion_2')->nullable();
            $table->text('localidad');
            $table->string('ip_cliente')->nullable();
            $table->string('delivery');
            $table->softDeletes();
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('pedidos');
    }
}
