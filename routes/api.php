<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/films'], function () {
    Route::get('/', 'FilmController@show');
    Route::post('/', 'FilmController@store');
    Route::get('/{slug}', 'FilmController@single');
    Route::post('/comment', 'CommentController@store');
    Route::get('/comment/{slug}', 'CommentController@show');
});

Route::post('/genre', 'GenreController@store');

