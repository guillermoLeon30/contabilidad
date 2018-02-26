<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarUnicoProductUnitMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_unit_measures', function (Blueprint $table) {
            $table->unique('unidad');
            $table->unique('simbolo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_unit_measures', function (Blueprint $table) {
            $table->dropUnique(['unidad']);
            $table->dropUnique(['simbolo']);
        });
    }
}
