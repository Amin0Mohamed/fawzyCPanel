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
        // main index route
        Route::get('settings','SettingController@index')->name('settings.index');

        // settings update route
        Route::post('settings/update','SettingController@update')->name('settings.update');

        Route::get('/setting/abstract/webs','SettingController@abstract_webs')->name('abstract_webs');
        Route::get('/setting/commit/feeds','SettingController@committee_feeds')->name('committee_feeds');
        Route::get('/setting/exhibitions','SettingController@Exhibiitionss')->name('Exhibiitionss');
        Route::get('/setting/main_topics','SettingController@main_topics')->name('main_topics');
        Route::get('/setting/new_feeds','SettingController@new_feeds')->name('new_feeds');
    });
});