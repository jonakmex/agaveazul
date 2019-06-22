<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResidenteAddToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residentes', function (Blueprint $table) {
            $table->integer('register_token_id')->unsigned()->nullable();
            $table->foreign('id')->references('register_token_id')->on('registerToken')->onDelete('cascade');
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
            $table->dropForeign('residentes_registerToken_id_foreign');
              $table->dropColumn('register_token_id');
        });
    }
}
