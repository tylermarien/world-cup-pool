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
    Route::apiResource('entries.players', 'EntryPlayerController')->except(['update', 'destroy']);
    Route::apiResource('entries.teams', 'EntryTeamController')->except(['update', 'destroy']);
    Route::apiResource('players', 'PlayerController');
    Route::apiResource('pools', 'PoolController');
    Route::apiResource('teams', 'TeamController');
});
