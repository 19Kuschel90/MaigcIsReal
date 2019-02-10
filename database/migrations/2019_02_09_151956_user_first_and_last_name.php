<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserFirstAndLastName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('userFirstAndLastName', function (Blueprint $table) {

        $table->increments('id');
        $table->integer('idUser');// can take the user
        $table->string('firstName');
        $table->string('lastName');
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
        Schema::dropIfExists('userFirstAndLastName');
    }
}
