<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tiendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tiendas', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->string('tienda');
        			$table->string('nit')->nullable();
        			$table->enum('regimen', array('Común', 'Simplificado'));
        			$table->string('prefijo')->nullable();
        			$table->string('telefono')->nullable();
        			$table->string('resolucion_dian')->nullable();
        			$table->string('rango')->nullable();
        			$table->date('fecha_dian')->nullable();
        			$table->longText('direccion')->nullable();
                    $table->integer('ciudad_id')->nullable();
                    $table->integer('company_id');
                    $table->integer('factura')->default(0);
                    $table->integer('remision')->default(0);
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
        Schema::drop('tiendas');
    }
}
