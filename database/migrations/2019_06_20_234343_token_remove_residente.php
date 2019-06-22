<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TokenRemoveResidente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registerTokens',function(Blueprint $table){
            $table->dropForeign('registerTokens_residentes_id_foreign');
              $table->dropColumn('residente_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registerTokens', function (Blueprint $table) {
            $table->integer('residente_id')->unsigned()->nullable();
            $table->foreign('id')->references('id')->on('residentes')->onDelete('cascade');
          });
    }
}
