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
    Route::get('login','AdminController@get_login')->name('admin_get');
    Route::post('login','AdminController@post_login')->name('admin_post');
    Route::group(['middleware'=>'adminauth'],function (){
        // admin index route
        Route::get('admins','AdminController@index')->name('admins.index');
        // admin create route
        Route::get('admins/create','AdminController@create')->name('admins.create');
        Route::post('admins/store','AdminController@store')->name('admins.store');

        // admin edit route
        Route::get('admins/edit/{id}','AdminController@edit')->name('admins.edit');
        Route::post('admins/update/{id}','AdminController@update')->name('admins.update');

        // admin delete route
        Route::post('admins/destroy','AdminController@destroy')->name('admins.destroy');

        // admin logout route
        Route::get('admins/logout','AdminController@logout')->name('admin_logout');
    });
});