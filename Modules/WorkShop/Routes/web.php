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
        // WorkShop index route
        Route::get('workshops','WorkShopController@index')->name('workshops.index');
        // WorkShop create route
        Route::get('workshops/create','WorkShopController@create')->name('workshops.create');
        Route::post('workshops/store','WorkShopController@store')->name('workshops.store');

        // WorkShop edit route
        Route::get('workshops/edit/{id}','WorkShopController@edit')->name('workshops.edit');
        Route::post('workshops/update/{id}','WorkShopController@update')->name('workshops.update');

        // WorkShop delete route
        Route::post('workshops/destroy','WorkShopController@destroy')->name('workshops.destroy');

    });
});