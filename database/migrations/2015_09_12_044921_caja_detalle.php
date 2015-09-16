<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CajaDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('caja_detalle', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->integer('caja_id');
        			$table->integer('formas_pago_id');
        			$table->string('concepto');
        			$table->decimal('valor',10,2);
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
        Schema::drop('caja_detalle');
    }
}
