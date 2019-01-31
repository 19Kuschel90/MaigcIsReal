<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Monster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('imgName');
            $table->integer('AP');// Attack
            $table->integer('DP');// Def
            $table->integer('Speed');// Speed
            $table->integer('SpwanWert');// Spwan Wert
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
        Schema::dropIfExists('monster');
    }
}
