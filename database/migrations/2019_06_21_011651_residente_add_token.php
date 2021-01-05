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
            $table->unsignedBigInteger('register_token_id');
            $table->foreign('register_token_id')->references('id')->on('registerTokens');
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
            $table->dropForeign('residentes_register_token_id_foreign');
            $table->dropColumn('register_token_id');
        });
    }
}
