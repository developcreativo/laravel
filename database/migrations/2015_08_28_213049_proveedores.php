<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Proveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('proveedores', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('proveedor')->index();
            $table->string('nit');
            $table->string('contacto');
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->string('telefono');
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
        Schema::drop('proveedores');
    }
}
