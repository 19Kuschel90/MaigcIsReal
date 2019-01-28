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

Route::get('/', 'indexController@index');
Route::post('/createAMoster', 'MosterController@createAMoster');
Route::post('/getAMoster', 'MosterController@getAMoster');
Route::post('/profil', 'indexController@GetYourUser')->name('user')->middleware("auth");;
Route::post('/updateUserData', 'indexController@updateUserData')->name('user')->middleware("auth");;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");
