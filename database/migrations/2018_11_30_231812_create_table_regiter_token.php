<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegiterToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('registerTokens', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('token')->index();
          $table->integer('profile_id')->unsigned();
          $table->integer('status')->unsigned();
          $table->integer('residente_id')->unsigned();
          $table->timestamps();

          $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
          $table->foreign('residente_id')->references('id')->on('residentes')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('registerTokens',function(Blueprint $table){
           $table->dropForeign('registerTokens_profile_id_foreign');
           $table->dropForeign('registerTokens_residente_id_foreign');
      });

      Schema::dropIfExists('registerTokens');
    }
}
