<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTricksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tricks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');

            /*User ID as Foreign Key in Tricks Table*/
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');

            /*Challenge ID as Foreign Key in Tricks Table*/
            $table->unsignedInteger('challenge_id');
            $table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');
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
        Schema::dropIfExists('tricks');
    }
}
