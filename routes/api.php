<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->middleware('auth:api')->group(function () {
    Route::apiResource('entries', 'EntryController');
    Route::apiResource('entries.players', 'EntryPlayerController')->only(['index', 'show']);
    Route::apiResource('entries.teams', 'EntryTeamController')->only(['index', 'show']);
    Route::apiResource('players', 'PlayerController');
    Route::apiResource('pools', 'PoolController');
    Route::apiResource('teams', 'TeamController');
    Route::post('users/entries/{entry}')->name('users.entries.store')->uses('UserEntryController@store');
});
