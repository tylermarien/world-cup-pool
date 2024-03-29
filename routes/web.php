<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'EntryController@index')->name('entries.index');
Route::get('/entries/{id}', 'EntryController@show')->name('entries.show');
Route::get('/entries/compare/{id1}/{id2}', 'EntryController@compare')->name('entries.compare');
Route::get('/teams/{id}', 'TeamController@show')->name('teams.show');
Route::get('/players/{id}', 'PlayerController@show')->name('players.show');
Route::get('/pools/toggle/{pool_id}', 'PoolController@toggle')->name('pools.toggle');

// // Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Route::namespace('Admin')
//     ->middleware('auth')
//     ->prefix('admin')
//     ->as('admin.')
//     ->group(function () {
//         Route::resource('entries', 'EntryController');
//     });

