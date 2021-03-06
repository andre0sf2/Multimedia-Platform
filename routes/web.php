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

Route::get('/', 'HomeController@index')->name('home');

Route::namespace('BackOffice')->group(function() {
    Route::get('/back-office', 'HomeController@index')->name('back-office');
});

Route::get('/movies', 'MovieController@getAllMovies')->name('movies');
Route::get('/movies/{name}', 'MovieController@getMovie')->name('movie');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

