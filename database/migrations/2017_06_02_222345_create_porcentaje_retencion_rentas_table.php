<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePorcentajeRetencionRentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porcentaje_retencion_rentas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->string('detalle');
            $table->decimal('porcertaje', 5, 2);
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('porcentaje_retencion_rentas');
    }
}
