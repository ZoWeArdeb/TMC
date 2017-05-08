<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/** COMPETITIONS */
Route::group(['prefix' => 'competition'], function() {
    Route::get('', 'CompetitionController@index')->name('competitions');
    Route::get('create', 'CompetitionController@create')->name('competitionCreate');
    Route::post('', 'CompetitionController@store')->name('competitionStore');
    Route::get('{competition}', 'CompetitionController@show')->name('competitionShow');
    Route::get('{competition}/edit', 'CompetitionController@edit')->name('competitionEdit');
    Route::patch('{competition}', 'CompetitionController@update')->name('competitionUpdate');
    Route::delete('{competition}', 'CompetitionController@destroy')->name('competitionDelete');

});

/** GAMES */
Route::group(['prefix' => 'game'], function() {

    Route::get('', 'GameController@index')->name('games');
    Route::get('create', 'GameController@create')->name('gameCreate');
    Route::post('', 'GameController@store')->name('gameStore');
    Route::get('{game}', 'GameController@show')->name('gameShow');
    Route::get('{game}/edit', 'GameController@edit')->name('gameEdit');
    Route::patch('{game}', 'GameController@update')->name('gameUpdate');
    Route::delete('{game}', 'GameController@destroy')->name('gameDelete');

    Route::get('{game}/score', 'GameController@scoreEdit')->name('gameScoreEdit');
    Route::post('{game}/score', 'GameController@scoreUpdate')->name('gameScoreUpdate');

});


/** TOURNAMENTS */
Route::group(['prefix' => 'tournament'], function() {

    Route::get('', 'TournamentController@index')->name('tournaments');
    Route::get('create', 'TournamentController@create')->name('tournamentCreate');
    Route::post('', 'TournamentController@store')->name('tournamentStore');
    Route::get('{tournament}', 'TournamentController@show')->name('tournamentShow');
    Route::get('{tournament}/edit', 'TournamentController@edit')->name('tournamentEdit');
    Route::patch('{tournament}', 'TournamentController@update')->name('tournamentUpdate');
    Route::delete('{tournament}', 'TournamentController@destroy')->name('tournamentDelete');

    Route::get('{tournament}/settings', 'TournamentController@settings')->name('tournamentSettings');
    Route::put('{tournament}/settings', 'TournamentController@storeSettings')->name('tournamentSettingsStore');

    Route::get('{tournament}/preview', 'TournamentController@preview')->name('tournamentPreview');
    Route::get('{tournament}/ranking', 'TournamentController@ranking')->name('tournamentRanking');

    /** LEAGUES */
    Route::group(['prefix' => '{tournament}/league'], function() {

        Route::get('', 'LeagueController@index')->name('leagues');
        Route::get('create', 'LeagueController@create')->name('leagueCreate');
        Route::post('', 'LeagueController@store')->name('leagueStore');
        Route::get('{league}', 'LeagueController@show')->name('leagueShow');
        Route::get('{league}/edit', 'LeagueController@edit')->name('leagueEdit');
        Route::patch('{league}', 'LeagueController@update')->name('leagueUpdate');
        Route::delete('{league}', 'LeagueController@destroy')->name('leagueDelete');

        Route::get('{league}/settings', 'LeagueController@settings')->name('leagueSettings');
        Route::put('{league}/settings', 'LeagueController@storeSettings')->name('leagueSettingsStore');

    });

        /** TEAMS */
    Route::group(['prefix' => '{tournament}/team'], function() {

        Route::get('', 'TeamController@index')->name('teams');
        Route::get('create', 'TeamController@create')->name('teamCreate');
        Route::post('', 'TeamController@store')->name('teamStore');
        Route::get('{team}', 'TeamController@show')->name('teamShow');
        Route::get('{team}/edit', 'TeamController@edit')->name('teamEdit');
        Route::patch('{team}', 'TeamController@update')->name('teamUpdate');
        Route::delete('{team}', 'TeamController@destroy')->name('teamDelete');

    });

    Route::group(['namespace' => 'Hulp'], function () {
        Route::get('{tournament}/generate', 'HulpController@generateTournament')->name('hulpTournamentGenerate');
        Route::get('{tournament}/fillscores', 'HulpController@fillAllScores')->name('hulpFillScores');
    });

    /** KNOCKOUT */
    Route::group(['prefix' => '{tournament}/knockout'], function() {

        Route::get('', 'KnockoutController@index')->name('knockouts');
        Route::get('create', 'KnockoutController@create')->name('knockoutCreate');
        Route::post('', 'KnockoutController@store')->name('knockoutStore');
        Route::get('{knockout}', 'KnockoutController@show')->name('knockoutShow');
        Route::get('{knockout}/edit', 'KnockoutController@edit')->name('knockoutEdit');
        Route::patch('{knockout}', 'KnockoutController@update')->name('knockoutUpdate');
        Route::delete('{knockout}', 'KnockoutController@destroy')->name('knockoutDelete');

    });

});

Auth::routes();

Route::get('/home', 'HomeController@index');
