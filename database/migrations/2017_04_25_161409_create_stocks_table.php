<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->integer('n_orden');
            $table->string('dimension');
            $table->string('color');
            $table->decimal('costo', 7, 2)->default(0);
            $table->decimal('ganancia_por_menor', 10, 2)->default(0);
            $table->decimal('ganancia_por_mayor', 10, 2)->default(0);
            $table->decimal('impuestos', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('precio_por_menor', 10, 2)->default(0);
            $table->decimal('precio_por_mayor', 10, 2)->default(0);
            $table->decimal('cantidad', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
