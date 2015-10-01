<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CuentasBancarias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cuentas_bancarias', function(Blueprint $table)
        		{
        			$table->increments('id');
        			$table->string('banco');
        			$table->integer('cuenta');
        			$table->string('tipo');
        			$table->string('titular');
        			$table->string('documento');
                    $table->boolean('principal');
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
        Schema::drop('cuentas_bancarias');
    }
}
