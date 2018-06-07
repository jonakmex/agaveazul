<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResidentesCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('residentes',function(Blueprint $table){
          $table->increments('id')->unsigned();
          $table->integer('vivienda_id')->unsigned();
          $table->foreign('vivienda_id')->references('id')->on('vivienda')->onDelete('cascade');
          $table->string('nombre');
          $table->string('email');
          $table->string('telefono');
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
      Schema::table('residentes',function(Blueprint $table){
           $table->dropForeign('residentes_vivienda_id_foreign');
       });
      Schema::dropIfExists('residentes');
    }
}
