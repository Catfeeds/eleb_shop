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

Route::get('/', function () {
    return view('welcome');
});
//user route
Route::resource('users','UserController');

//session route
Route::get('session/login','SessionController@login')->name('login');
Route::post('session/verify','SessionController@verify')->name('session.verify');
Route::get('session/logout','SessionController@logout')->name('session.logout');
Route::get('session/eidt','SessionController@edit')->name('session.edit');
Route::post('session/store','SessionController@store')->name('session.store');


//menuCategory route
Route::resource('menucategories','MenuCategoryController');

//menu route
Route::resource('menus','MenuController');
Route::get('search','MenuController@search')->name('search');

//artivity route
Route::get('activity','ActivityController@index')->name('activity.index');
Route::get('activity/view/{activity}','ActivityController@view')->name('activity.view');

//upload route
Route::post('upload','UploaderController@upload')->name('elebshop.upload');

//events route
Route::get('/events','EventController@index')->name('events.index');
Route::get('/events/signup/{event}','EventController@signup')->name('events.signup');
Route::get('/events/view/{event}','EventController@view')->name('events.view');