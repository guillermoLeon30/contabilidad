<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaPorPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_por_pagar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('compra_id')->unsigned()->default(0);
            $table->bigInteger('provider_id')->unsigned()->default(0);
            $table->integer('cls_cta_x_pagar_id')->unsigned()->default(0);
            $table->string('acreedor')->default('');
            $table->date('fecha_vencimiento');
            $table->integer('valor_plazo');
            $table->string('tiempo_plazo');
            $table->decimal('total', 10, 2);
            $table->decimal('pagos_efectuados', 10, 2)->default(0);
            $table->decimal('saldo', 10, 2)->default(0);
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
        Schema::dropIfExists('cuentas_por_pagar');
    }
}
