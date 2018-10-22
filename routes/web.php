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