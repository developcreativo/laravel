<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Despachos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('despachos', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->integer('factura_id');
        			$table->text('direccion');
                    $table->integer('ciudad_id');
                    $table->integer('transportadora_id')->nullable();
                    $table->string('estado')->nullable();
                    $table->string('guia')->nullable();
                    $table->integer('flete')->nullable();
                    $table->integer('tienda_id')->nullable();
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
    }
}
