<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompraDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('compra_detalle', function(Blueprint $table)
        		{
        			$table->increments('id');
                    $table->integer('compra_id');
                    $table->string('producto_configurable_id');
                    $table->integer('cantidad');
                    $table->integer('valor');
                    $table->integer('iva');
                    $table->integer('dto');
                    $table->integer('sub_total');
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
        Schema::drop('compra_detalle');
    }
}
