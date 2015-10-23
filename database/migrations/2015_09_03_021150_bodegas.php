<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bodegas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bodegas_0', function(Blueprint $table)
        		{
                    $table->increments('id');
                    $table->string('codigo');
                    $table->integer('cantidad');
                    $table->integer('venta');
                    $table->integer('compra');
                    $table->decimal('iva',4,2);
                    $table->boolean('remision');
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
        Schema::drop('bodegas_0');

    }
}
