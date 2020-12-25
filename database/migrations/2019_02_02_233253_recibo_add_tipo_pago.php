<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReciboAddTipoPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('recibos', function (Blueprint $table) {
        $table->integer('tipo_pago')->unsigned()->nullable();
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
        $table->dropColumn('tipo_pago');
      });
        
    }
}
