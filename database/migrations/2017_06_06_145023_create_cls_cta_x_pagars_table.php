<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClsCtaXPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cls_ctas_x_pagar', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->string('cuenta');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cls_ctas_x_pagar');
    }
}
