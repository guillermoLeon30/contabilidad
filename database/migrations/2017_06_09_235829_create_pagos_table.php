<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cuentas_por_pagar_id')->unsigned();
            $table->date('fecha');
            $table->integer('cls_pagos_id')->unsigned();
            $table->string('numero_documento')->default('');
            $table->decimal('total', 10, 2)->default(0);
            $table->string('estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cuentas_por_pagar_id')->references('id')->on('cuentas_por_pagar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
