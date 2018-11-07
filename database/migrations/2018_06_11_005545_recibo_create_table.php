<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReciboCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('recibos',function(Blueprint $table){
        $table->increments('id')->unsigned();
        $table->integer('reciboheader_id')->unsigned();
        $table->foreign('reciboheader_id')->references('id')->on('reciboheader')->onDelete('cascade');
        $table->integer('vivienda_id')->unsigned();
        $table->foreign('vivienda_id')->references('id')->on('vivienda')->onDelete('cascade');
        $table->string('descripcion');
        $table->string('comprobante')->nullable();
        $table->string('emision')->nullable();
        $table->date('fecLimite');
        $table->date('fecPago')->nullable();
        $table->decimal('importe',10,2);
        $table->decimal('ajuste',10,2)->nullable();
        $table->decimal('saldo',10,2);
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
      Schema::table('recibos',function(Blueprint $table){
           $table->dropForeign('recibos_reciboheader_id_foreign');
           $table->dropForeign('recibos_vivienda_id_foreign');
       });
      Schema::dropIfExists('recibos');
    }
}
