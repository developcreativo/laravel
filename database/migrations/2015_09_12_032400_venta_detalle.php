<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VentaDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('venta_detalle', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->integer('venta_id');
        			$table->integer('producto_configurable_id');
        			$table->integer('venta');
        			$table->integer('compra');
        			$table->integer('iva')->nullable();
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
        //
        Schema::drop('venta_detalle');
    }
}
