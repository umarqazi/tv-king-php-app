<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableChallengesAddWinnerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->unsignedInteger('winner_id')->nullable();
            $table->dateTime('winner_at')->nullable();
            $table->foreign('winner_id')->references('id')->on('tricks')->onDelete('cascade');
            $table->text('winner_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->dropForeign('challenges_winner_id_foreign');
            $table->dropColumn('winner_id');
            $table->dropColumn('winner_notes');
            $table->dropColumn('winner_at');
        });
    }
}
