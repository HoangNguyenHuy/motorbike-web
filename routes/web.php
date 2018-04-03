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

Route::get('/','home@getHomePage')->name('home');

Route::get('/login','Auth\LoginController@index')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::group(['middleware' => 'isLogin'], function () {
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::post('/save-avatar','admin\UserController@save_avatar');
    Route::get('/user-info','admin\UserController@index')->name('user-info');
    Route::post('/user-info/{id}','admin\UserController@update')->name('edit-user');
    Route::get('/manufacturer','admin\ManufacturerController@index')->name('manufacturer');
    Route::post('/manufacturer','admin\ManufacturerController@create')->name('add-manufacturer');
});