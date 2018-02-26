<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('provider_id')->unsigned();
            $table->date('fecha_compra');
            $table->string('factura');
            $table->decimal('monto_no_facturado', 10, 2)->default(0);
            $table->decimal('monto_facturado', 10, 2)->default(0);
            $table->decimal('iva_compra', 10, 2)->default(0);
            $table->decimal('retencion_iva', 10, 2)->default(0);
            $table->decimal('retencion_renta', 10, 2)->default(0);
            $table->decimal('porcentaje_retencion_iva', 10, 2)->default(0);
            $table->decimal('porcentaje_retencion_renta', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
