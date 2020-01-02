<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//authentication
Route::post('login'    , 'API\UserController@login');
Route::post('register' , 'API\UserController@register');


//contact us
Route::post('contactus','API\ContactUsController@store');

//Faculities
Route::post('insert_faculty','API\FacultyController@insert_faculty');
Route::get('all_faculities','API\FacultyController@all_faculities');
Route::get('get_faculty','API\FacultyController@get_faculty');

//exhibitions
Route::get('all_exhibitions','API\ExhibitionController@all_exhibitions');
Route::get('get_exhibition','API\ExhibitionController@get_exhibition');

//venue
Route::post('insert_venue','API\VenueController@insert_venue');
Route::get('display_venue','API\VenueController@display_venue');

Route::post('insert_Message','API\MessageController@insert_Message');

//main_topic
Route::post('topic','API\MainController@main_topic');
Route::get('show','API\MainController@show');
Route::get('Rate','API\RateController@insert_rate');

//Home
Route::post('insert_into_home','API\HomeController@insert_into_home');
Route::get('display_home_details','API\HomeController@display_home_details');

//committee_feeds
Route::post('insert_committee','API\Committee_feedController@insert_committee');
Route::get('display_committee','API\Committee_feedController@display_committee');

//program
Route::get('display_programs','API\ProgramController@display_programs');

//main program
Route::get('display_program','API\MainProgramController@display_program');

//new_feed
Route::get('new_feed','API\New_feedController@new_feed');

//workshop
Route::post('workshop','API\WorkshopController@workshop');
Route::post('getAllWorkShow','API\WorkshopController@getAllWorkShow');

//abstract
Route::get('getAbstract','API\Abstract_webController@getAbstract');

//update_profile
Route::post('update/profile','API\UserController@update_profile');

//settings
Route::get('settings','API\UserController@settings');






