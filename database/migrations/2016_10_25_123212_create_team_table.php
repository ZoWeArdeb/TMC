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
            $table->text('settings')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('league', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('tournament_id')->unsigned()->unique();
            $table->integer('parent')->nullable()->unsigned(); 
            $table->timestamps();
        });

        Schema::table('league', function (Blueprint $table) { 
            $table->foreign('parent')->references('id')->on('league'); 
            $table->foreign('tournament_id')->references('id')->on('tournament');
        }); 

        Schema::create('team', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('league_id')->unsigned()->unique();
            $table->timestamps();
        });

        Schema::table('team', function (Blueprint $table) {
            $table->foreign('league_id')->references('id')->on('league');
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
