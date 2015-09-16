<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Compras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('compras', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('factura',200)->index();
            $table->integer('proveedor_id');
            $table->date('fecha_vencimiento');
            $table->biginteger('valor_total');
            $table->biginteger('sub_total');
            $table->integer('iva');
            $table->integer('dto');
            $table->integer('retefuente');
            $table->biginteger('pagado');
            $table->boolean('remision');
            $table->integer('tienda_id');
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
        Schema::drop('compras');
    }
}
