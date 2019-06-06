<?php

use App\Article;
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

Route::post('register',  array('middleware' => 'cors', 'uses' => 'Auth\AuthController@register'))->name('register');
Route::post('login',  array('middleware' => 'cors', 'uses' => 'Auth\AuthController@login'))->name('login');
Route::post('user/{id}',  array('middleware' => 'cors', 'uses' => 'Auth\AuthController@update'))->name('update');
Route::get('/user',  array('middleware' => 'cors', 'uses' => 'Auth\AuthController@user'));
Route::post('/logout', array('middleware' => 'cors', 'uses' => 'Auth\AuthController@logout'));

Route::apiResource('films','Api\FilmController');
Route::apiResource('articles','Api\ArticleController');

Route::get('letter/{letter}', array('middleware' => 'cors', 'uses' => 'Api\APIController@show'));
