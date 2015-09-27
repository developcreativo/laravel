<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Departamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('departamentos', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->string('departamento');
                    $table->integer('pais_id')->nullable();
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
        Schema::drop('departamentos');
    }
}
