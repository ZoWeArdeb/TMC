<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->integer('home_team_id')->unsigned();
            $table->integer('away_team_id')->unsigned();
            $table->integer('score_home')->nullable()->unsigned();
            $table->integer('score_away')->nullable()->unsigned();
            $table->dateTime('play_at');
            $table->boolean('postponed')->default(false);
            $table->integer('score_home_et')->nullable()->unsigned();
            $table->integer('score_away_et')->nullable()->unsigned();
            $table->integer('score_home_p')->nullable()->unsigned();
            $table->integer('score_away_p')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('game', function (Blueprint $table) {
            $table->foreign('home_team_id')->references('id')->on('team');
            $table->foreign('away_team_id')->references('id')->on('team');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game', function (Blueprint $table) {
            $table->dropForeign('game_home_team_id_foreign');
            $table->dropForeign('game_away_team_id_foreign');
        });

        Schema::dropIfExists('game');
    }
}
