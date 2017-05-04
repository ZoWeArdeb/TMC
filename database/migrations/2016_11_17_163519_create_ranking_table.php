<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking', function (Blueprint $table) {
            $table->integer('league_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->integer('win')->unsigned()->default(0);
            $table->integer('draw')->unsigned()->default(0);
            $table->integer('loss')->unsigned()->default(0);
            $table->integer('for')->unsigned()->default(0);
            $table->integer('against')->unsigned()->default(0);
            $table->primary(['league_id', 'team_id']);
        });

        Schema::table('ranking', function (Blueprint $table) {
            $table->foreign('league_id')->references('id')->on('league');
            $table->foreign('team_id')->references('id')->on('team');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranking', function (Blueprint $table) {
            $table->dropForeign('ranking_league_id_foreign');
            $table->dropForeign('ranking_team_id_foreign');
        });

        Schema::dropIfExists('ranking');
    }
}
