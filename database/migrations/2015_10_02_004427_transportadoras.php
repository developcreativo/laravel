<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transportadoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transportadoras', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->string('transportadora');
        			$table->string('telefono');
        			$table->string('contacto');
        			$table->string('email');
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
        Schema::drop('transportadoras');
    }
}
