<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivityDespachos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('activity_despachos', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->integer('despacho_id');
        			$table->integer('user_id');
        			$table->string('concepto')->nullable();
        			$table->string('estado');
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
        Schema::drop('activity_despachos');
    }
}
