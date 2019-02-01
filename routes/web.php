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
Route::post('/createAMonster', 'MonsterController@createAMonster');
Route::post('/getAMonster', 'MonsterController@getAMonster');
Route::post('/ramdomSpawn', 'MonsterController@ramdomSpawn');
Route::post('/getLastMonster', 'MonsterController@getLastMonster');
Route::post('/profil', 'indexController@GetYourUser')->name('user')->middleware("auth");;
Route::post('/updateUserData', 'indexController@updateUserData')->name('user')->middleware("auth");;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");

