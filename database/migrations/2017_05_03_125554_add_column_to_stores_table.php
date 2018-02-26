<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('stores', function (Blueprint $table) {
            $table->enum('tipo', ['matriz', 'sucursal'])->after('id');
            $table->bigInteger('empresa_id')->unsigned()->after('ciudad');
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
            $table->dropColumn('empresa_id');
        });
    }
}
