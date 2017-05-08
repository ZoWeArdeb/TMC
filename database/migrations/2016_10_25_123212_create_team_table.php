<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('league', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('settings')->nullable();
            $table->integer('tournament_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('league', function (Blueprint $table) { 
            $table->foreign('tournament_id')->references('id')->on('tournament');
        }); 

        Schema::create('group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('league_id')->nullable()->unsigned();
            $table->integer('parent_id')->nullable()->unsigned(); 
            $table->timestamps();
        });

        Schema::table('group', function (Blueprint $table) { 
            $table->foreign('parent_id')->references('id')->on('group'); 
            $table->foreign('league_id')->references('id')->on('league');
        }); 


        Schema::create('team', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('league_id')->unsigned();
            $table->integer('group_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('team', function (Blueprint $table) {
            $table->foreign('league_id')->references('id')->on('league');
            $table->foreign('group_id')->references('id')->on('group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team');
    }
}
