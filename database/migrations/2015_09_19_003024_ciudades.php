<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ciudades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ciudades', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->string('ciudad');
                    $table->integer('departamento_id');
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
        Schema::drop('ciudades');
    }
}
