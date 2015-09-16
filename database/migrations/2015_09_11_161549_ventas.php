<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ventas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ventas', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->string('factura');
        			$table->integer('cliente_id');
        			$table->integer('tienda_id');
        			$table->integer('user_id');
        			$table->decimal('venta',10,2);
        			$table->decimal('iva',10,2);
        			$table->boolean('pagado');
        			$table->boolean('remision');
                    $table->integer('plazo');
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
        Schema::drop('ventas');
    }
}
