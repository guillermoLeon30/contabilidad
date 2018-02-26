<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProvidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->text('descripcion')->after('tipo');
            $table->string('direccion')->after('descripcion');
            $table->string('ciudad')->after('direccion');
            $table->string('provincia')->after('ciudad');
            $table->string('pais')->after('ciudad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->dropColumn(['descripcion', 'direccion', 'ciudad', 'provincia', 'pais']);
        });
    }
}
