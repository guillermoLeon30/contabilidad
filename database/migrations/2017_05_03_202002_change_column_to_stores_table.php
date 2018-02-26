<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->enum('tipo', ['Matriz', 'Sucursal'])->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->enum('tipo', ['matriz', 'sucursal'])->after('id');
        });
    }
}
