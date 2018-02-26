<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdEmpresaToManyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->bigInteger('empresa_id')->unsigned()->after('color');
        });

        Schema::table('product_marks', function (Blueprint $table) {
            $table->bigInteger('empresa_id')->unsigned()->after('marca');
        });

        Schema::table('product_unit_measures', function (Blueprint $table) {
            $table->bigInteger('empresa_id')->unsigned()->after('simbolo');
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->bigInteger('empresa_id')->unsigned()->after('categoria');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('empresa_id')->unsigned()->after('unidades');
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
            $table->dropColumn('empresa_id');
        });

        Schema::table('product_marks', function (Blueprint $table) {
            $table->dropColumn('empresa_id');
        });

        Schema::table('product_unit_measures', function (Blueprint $table) {
            $table->dropColumn('empresa_id');
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn('empresa_id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('empresa_id');
        });
    }
}
