<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('compra_id')->unsigned();
            $table->bigInteger('product_stock');
            $table->decimal('cantidad', 10, 2);
            $table->timestamps();

            $table->foreign('compra_id')->references('id')->on('compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_compras');
    }
}
