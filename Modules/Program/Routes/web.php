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
        // program index route
        Route::get('programs','ProgramController@index')->name('programs.index');
        // program create route
        Route::get('programs/create','ProgramController@create')->name('programs.create');
        Route::post('programs/store','ProgramController@store')->name('programs.store');

        // program edit route
        Route::get('programs/edit/{id}','ProgramController@edit')->name('programs.edit');
        Route::post('programs/update/{id}','ProgramController@update')->name('programs.update');

        // program delete route
        Route::post('programs/destroy','ProgramController@destroy')->name('programs.destroy');

    });
});