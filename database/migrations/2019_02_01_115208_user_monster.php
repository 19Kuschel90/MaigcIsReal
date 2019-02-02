<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserMonster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('userMonster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');// can take the user
            $table->string('imgName');
            $table->integer('idUser');// user Id
            $table->integer('AP');// Attack
            $table->integer('DP');// Def
            $table->integer('HP');// Hit points
            $table->integer('Speed');// Speed
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
        Schema::dropIfExists('userMonster');
    }
}
