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
Route::post('/iMLogin', 'UserMonsterController@iMLogin');// is a check
Route::post('/createAMonster', 'MonsterController@createAMonster');// all User can create a monster
Route::post('/getLastMonster', 'MonsterController@getLastMonster');
Route::post('/getAMonster', 'MonsterController@getAMonster');
Route::post('/ramdomSpawn', 'MonsterController@ramdomSpawn');

Route::post('/getUserName', 'indexController@getUserName');
Route::post('/getUserMonster', 'UserMonsterController@getUserMonster');
Route::post('/createAUserMonster', 'UserMonsterController@createAUserMonster')->name('user')->middleware("auth")->middleware('verified');// user monster
Route::post('/profil', 'indexController@GetYourUser')->name('user')->middleware("auth")->middleware('verified');
Route::post('/updateUserData', 'indexController@updateUserData')->name('user')->middleware("auth")->middleware('verified');
Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");



Auth::routes(['verify' => true]);
// Route::get('/Myprofile', function()
// {
//     return "this is profile";
// })->middleware('verified');

