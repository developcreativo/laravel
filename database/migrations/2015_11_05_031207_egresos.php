<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Egresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('egresos', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->integer('compra_id')->nullable();
        			$table->integer('gasto_id')->nullable();
        			$table->integer('formas_pago_id')->nullable();
        			$table->decimal('valor',16,2);
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
        Schema::drop('egresos');
    }
}
