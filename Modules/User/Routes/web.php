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
Route::group(['prefix' => 'admin-panel'],function (){

    Route::group(['middleware'=>'adminauth'],function (){
        // user index route
        Route::get('users','UserController@index')->name('users.index');
        // user create route
        Route::get('users/create','UserController@create')->name('users.create');
        Route::post('users/store','UserController@store')->name('users.store');

        // user edit route
        Route::get('users/edit/{id}','UserController@edit')->name('users.edit');
        Route::post('users/update/{id}','UserController@update')->name('users.update');

        // user delete route
        Route::post('users/destroy','UserController@destroy')->name('users.destroy');

    });
});