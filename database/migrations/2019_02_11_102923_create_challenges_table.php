<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('brand_id')->nullable();
            $table->string('name');
            $table->text('description');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->point('location')->nullable();
            $table->string('reward');
            $table->string('reward_notes');
            $table->string('reward_url');
            $table->boolean('published')->default(false);
            $table->dateTime('published_at')->nullable();

            /*User ID as Foreign Key in Challenges Table*/
            $table->foreign('brand_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('challanges');
    }
}
