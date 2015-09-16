<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ingresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ingresos', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->integer('venta_id');
        			$table->integer('remision_id');
        			$table->integer('formas_pago_id');
        			$table->integer('valor');
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
        Schema::drop('ingresos');
    }
}
