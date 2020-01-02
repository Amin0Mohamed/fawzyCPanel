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
        // Faculties index route
        Route::get('faculties','FacultyController@index')->name('faculties.index');
        // Faculties create route
        Route::get('faculties/create','FacultyController@create')->name('faculties.create');
        Route::post('faculties/store','FacultyController@store')->name('faculties.store');

        // Faculties edit route
        Route::get('faculties/edit/{id}','FacultyController@edit')->name('faculties.edit');
        Route::post('faculties/update/{id}','FacultyController@update')->name('faculties.update');

        // Faculties delete route
        Route::post('faculties/destroy','FacultyController@destroy')->name('faculties.destroy');

    });
});