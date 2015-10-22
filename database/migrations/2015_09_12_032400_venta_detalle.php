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
        			$table->string('producto');
        			$table->integer('cantidad');
        			$table->decimal('venta',10,2);
        			$table->decimal('compra',10,2);
        			$table->integer('iva')->nullable();
        			$table->integer('dto')->nullable();
					$table->decimal('subtotal',10,2)->nullable();
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
