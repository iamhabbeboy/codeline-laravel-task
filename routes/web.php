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

Route::get('/', function () {
    return redirect(route('homepage'));
});

Route::get('/films', 'FilmFrontendController@index')->name('homepage');
Route::get('/films/create', 'FilmFrontendController@create')->name('create_film')->middleware('auth');
Route::get('/films/{slug}', 'FilmFrontendController@single')->name('single_film_page');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
