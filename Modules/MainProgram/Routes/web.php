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
        // main program index route
        Route::get('main/{id}/programs','MainProgramController@index')->name('main.programs.index');
        // main program create route
        Route::get('main/programs/{id}/create','MainProgramController@create')->name('main.programs.create');
        Route::post('main/programs/store','MainProgramController@store')->name('main.programs.store');

        // main program edit route
        Route::get('main/programs/edit/{id}','MainProgramController@edit')->name('main.programs.edit');
        Route::post('main/programs/update/{id}','MainProgramController@update')->name('main.programs.update');

        // main program delete route
        Route::post('main/programs/destroy','MainProgramController@destroy')->name('main.programs.destroy');

    });
});