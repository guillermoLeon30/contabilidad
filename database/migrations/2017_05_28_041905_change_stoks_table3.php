<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStoksTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->renameColumn('precio_por_menor_sin_iva', 'precio_por_menor_inc_iva');
            $table->renameColumn('precio_por_mayor_sin_iva', 'precio_por_mayor_inc_iva');
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
            $table->renameColumn('precio_por_menor_inc_iva', 'precio_por_menor_sin_iva');
            $table->renameColumn('precio_por_mayor_inc_iva', 'precio_por_mayor_sin_iva');
        });
    }
}
