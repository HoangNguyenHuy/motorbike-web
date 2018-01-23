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

Route::get('/','home@getHomePage');
Route::get('/admin','admin\LoginController@getLogin');
Route::get('login','admin\LoginController@getLogin');
Route::post('/admin','admin\LoginController@postLogin');