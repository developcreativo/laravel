<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('productos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('SKU');
            $table->string('producto')->index();
            $table->string('imagen');
            $table->string('descripcion');
            $table->integer('categoria_id');
            $table->integer('marca_id');
            $table->integer('venta');
            $table->integer('compra');
            $table->integer('impuestos');
            $table->decimal('rentabilidad',10,2);
            $table->integer('atributo_1');
            $table->integer('atributo_2');
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
        Schema::drop('productos');
    }
}
