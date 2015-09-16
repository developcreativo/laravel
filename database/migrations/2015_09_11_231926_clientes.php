<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Clientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clientes', function(Blueprint $table)
        		{
        			$table->increments('id');
                    $table->integer('documento')->nullable();
                    $table->string('cliente');
                    $table->string('email')->nullable();
        			$table->integer('telefono')->nullable();
        			$table->longText('direccion')->nullable();
                    $table->integer('deuda_maxima')->nullable();
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
        Schema::drop('clientes');
    }
}
