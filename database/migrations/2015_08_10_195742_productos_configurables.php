<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductosConfigurables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('productos_configurables', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('producto')->unique()->index();
            $table->integer('variable_1');
            $table->integer('variable_2');
            $table->integer('producto_id');
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
        Schema::drop('productos_configurables');
    }
}
