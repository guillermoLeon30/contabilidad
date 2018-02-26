<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSotcksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('costo');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->renameColumn('impuestos', 'descuento_por_menor');
            $table->renameColumn('descuento', 'descuento_por_mayor');
            $table->renameColumn('precio_por_menor', 'precio_por_menor_sin_iva');
            $table->renameColumn('precio_por_mayor', 'precio_por_mayor_sin_iva');
            
            $table->decimal('costo', 10, 2)->default(0)->after('dimension');
            $table->decimal('iva_compra', 10, 2)->default(0)->after('costo');
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
            $table->renameColumn('descuento_por_menor', 'impuestos');
            $table->renameColumn('descuento_por_mayor', 'descuento');
            $table->renameColumn('precio_por_menor_sin_iva', 'precio_por_menor');
            $table->renameColumn('precio_por_mayor_sin_iva', 'precio_por_mayor');
            $table->dropColumn('iva_compra');
            $table->decimal('costo', 7, 2)->after('dimension');
        });
    }
}
