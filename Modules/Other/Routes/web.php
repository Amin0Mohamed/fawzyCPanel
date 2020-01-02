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
        // chairs index route
        Route::get('chairs/index','ChairController@index')->name('chairs.index');
        // chairs create route
        Route::get('chairs/create','ChairController@create')->name('chairs.create');
        Route::post('chairs/store','ChairController@store')->name('chairs.store');
        // chairs edit route
        Route::get('chairs/{id}/edit','ChairController@edit')->name('chairs.edit');
        Route::post('chairs/{id}/update','ChairController@update')->name('chairs.update');
        // chairs delete route
        Route::post('chairs/destroy','ChairController@destroy')->name('chairs.destroy');

        // messages index route
        Route::get('messages/index','OtherController@index')->name('messages.index');

        // presentations index route
        Route::get('presentations/index','PresentationController@index')->name('presentations.index');
        // presentations create route
        Route::get('presentations/create','PresentationController@create')->name('presentations.create');
        Route::post('presentations/store','PresentationController@store')->name('presentations.store');
        // presentations edit route
        Route::get('presentations/{id}/edit','PresentationController@edit')->name('presentations.edit');
        Route::post('presentations/{id}/update','PresentationController@update')->name('presentations.update');
        // presentations delete route
        Route::post('presentations/destroy','PresentationController@destroy')->name('presentations.destroy');

    });
});