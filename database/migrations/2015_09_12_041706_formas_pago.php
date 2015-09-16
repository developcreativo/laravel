<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormasPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('formas_pago', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->string('forma_pago');
                    $table->decimal('comision',5,2)->nullable();
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
        Schema::drop('formas_pago');
    }
}
