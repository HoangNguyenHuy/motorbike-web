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
// TODO refactor resource using Route::resource()
// link https://stackoverflow.com/questions/23505875/laravel-routeresource-vs-routecontroller
// https://laracasts.com/discuss/channels/general-discussion/using-custom-name-for-resource-routes?page=2
// Route::resource('login', 'Auth\LoginController');

Route::get('/login','Auth\LoginController@index')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::group(['middleware' => 'isLogin'], function () {
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::post('/save-avatar','admin\UserController@save_avatar');
    Route::get('/user-info','admin\UserController@index')->name('user-info');
    Route::post('/user-info/{id}','admin\UserController@update')->name('edit-user');
    Route::get('/manufacturer','admin\ManufacturerController@index')->name('manufacturer');
    Route::post('/manufacturer','admin\ManufacturerController@store')->name('add-manufacturer');
    Route::get('/manufacturer/{id}/edit','admin\ManufacturerController@edit')->name('edit-manufacturer');
    Route::post('/manufacturer/{id}','admin\ManufacturerController@update')->name('edit-manufacturer');
    Route::delete('/manufacturer/{id}','admin\ManufacturerController@destroy')->name('delete-manufacturer');
    Route::post('/motor-type','admin\MotorTypeController@store')->name('add-motor-type');
    Route::put('/motor-type/{id}','admin\MotorTypeController@update')->name('edit-motor-type');
    Route::delete('/motor-type/{id}','admin\MotorTypeController@destroy')->name('delete-motor-type');
});
