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
        			$table->integer('cliente_id');
        			$table->string('direccion');
                    $table->integer('ciudad_id');
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
