<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CuotaViviendaCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cuota_viviendas',function(Blueprint $table){
          $table->increments('id')->unsigned();
          $table->integer('cuota_id')->unsigned();
          $table->integer('vivienda_id')->unsigned();
          $table->foreign('cuota_id')->references('id')->on('cuotas');
          $table->foreign('vivienda_id')->references('id')->on('vivienda');
          $table->unique(['cuota_id', 'vivienda_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('cuota_viviendas',function(Blueprint $table){
           $table->dropForeign('cuota_viviendas_cuota_id_foreign');
           $table->dropForeign('cuota_viviendas_vivienda_id_foreign');
       });
      Schema::dropIfExists('cuota_viviendas');
    }
}
