<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAttrUniqueVariasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->dropUnique(['color']);
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropUnique(['categoria']);
        });

        Schema::table('product_marks', function (Blueprint $table) {
            $table->dropUnique(['marca']);
        });

        Schema::table('product_unit_measures', function (Blueprint $table) {
            $table->dropUnique(['unidad']);
            $table->dropUnique(['simbolo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->unique('color');
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->unique('categoria');
        });

        Schema::table('product_marks', function (Blueprint $table) {
            $table->unique('marca');
        });

        Schema::table('product_unit_measures', function (Blueprint $table) {
            $table->unique('unidad');
            $table->unique('simbolo');
        });
    }
}
