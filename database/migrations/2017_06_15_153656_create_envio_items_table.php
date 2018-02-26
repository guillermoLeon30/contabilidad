<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvioItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envio_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('envio_id')->unsigned();
            $table->bigInteger('product_stock_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('stock_id')->unsigned();
            $table->string('color');
            $table->decimal('contidad', 10,2);
            $table->timestamps();

            $table->foreign('envio_id')->references('id')->on('envios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envio_items');
    }
}
