<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecCuentamovimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('cuentamovimiento', function (Blueprint $table) {
        $table->integer('recibos_id')->unsigned()->nullable();
        $table->foreign('recibos_id')->references('id')->on('recibos')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('cuentamovimiento',function(Blueprint $table){
           $table->dropForeign('cuentamovimiento_recibos_id_foreign');
	         $table->dropColumn('recibos_id');
       });
    }
}
