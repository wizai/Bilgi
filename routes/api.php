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

Route::post('register',  array('middleware' => 'cors', 'uses' => 'Auth\AuthController@register'))->name('register');
Route::post('login',  array('middleware' => 'cors', 'uses' => 'Auth\AuthController@login'))->name('login');
Route::get('/user',  array('middleware' => 'cors', 'uses' => 'Auth\AuthController@user'));
Route::post('/logout', array('middleware' => 'cors', 'uses' => 'Auth\AuthController@logout'));
Route::get('letter/{letter}', array('middleware' => 'cors', 'uses' => 'ArticleController@show'));
