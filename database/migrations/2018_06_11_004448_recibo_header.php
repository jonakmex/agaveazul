<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReciboHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reciboheader',function(Blueprint $table){
          $table->increments('id')->unsigned();
          $table->integer('cuota_id')->unsigned();
          $table->foreign('cuota_id')->references('id')->on('cuotas')->onDelete('cascade');
          $table->string('descripcion');
          $table->decimal('importe',10,2);
          $table->decimal('saldo',10,2);
          $table->date('fecVence');
          $table->date('fecLimite');
          $table->integer('estado')->unsigned;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('reciboheader',function(Blueprint $table){
           $table->dropForeign('reciboheader_cuotas_id_foreign');
       });
       Schema::dropIfExists('reciboheader');
    }
}
