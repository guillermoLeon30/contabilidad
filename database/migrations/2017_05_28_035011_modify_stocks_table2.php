<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyStocksTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn(['porcentaje_ganancia_por_menor', 'porcentaje_ganancia_por_mayor', 'porcentaje_descuento_por_menor', 'porcentaje_descuento_por_mayor']);
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->decimal('pocentaje_ganancia_por_menor', 5, 2)->default(0)->after('ganancia_por_menor');
            $table->decimal('pocentaje_ganancia_por_mayor', 5, 2)->default(0)->after('ganancia_por_mayor');
            $table->decimal('porcentaje_descuento_por_menor', 5, 2)->default(0)->after('descuento_por_menor');
            $table->decimal('porcentaje_descuento_por_mayor', 5, 2)->default(0)->after('descuento_por_mayor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn(['porcentaje_ganancia_por_menor', 'porcentaje_ganancia_por_mayor', 'porcentaje_descuento_por_menor', 'porcentaje_descuento_por_mayor']);
        });


        Schema::table('stocks', function (Blueprint $table) {
            $table->integer('porcentaje_ganancia_por_menor')->default(0)->after('ganancia_por_menor');
            $table->integer('porcentaje_ganancia_por_mayor')->default(0)->after('ganancia_por_mayor');
            $table->integer('porcentaje_descuento_por_menor')->default(0)->after('descuento_por_menor');
            $table->integer('porcentaje_descuento_por_mayor')->default(0)->after('descuento_por_mayor');
        });
    }
}
