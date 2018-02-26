<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsEnvioItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('envio_items', function (Blueprint $table) {
            $table->bigInteger('items_compras_id')->unsigned()->after('envio_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('envio_items', function (Blueprint $table) {
            $table->dropColumn('items_compras_id');
        });
    }
}
