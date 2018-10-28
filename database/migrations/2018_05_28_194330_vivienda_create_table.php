<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViviendaCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vivienda',function(Blueprint $table){
            $table->increments('id')->unsigned;
            $table->string('descripcion',100);
            $table->string('clave',10);
            $table->integer('estado')->unsigned;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vivienda');
    }
}
