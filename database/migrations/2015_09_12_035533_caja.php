<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Caja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('caja', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->integer('tienda_id');
        			$table->decimal('apertura',10,2);
        			$table->decimal('cierre',10,2)->nullable();
        			$table->boolean('estado')->default(1);
        			$table->boolean('descuadre')->default(0);
        			$table->longText('nota')->nullable();
                    $table->integer('user_id');
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
        Schema::drop('caja');
    }
}
