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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'IndexController@index');

Route::get('/statistics', 'StatisticsController@index')->name('statistics');

Route::get('/usercontrol', 'UserControlController@index')->name('usercontrol');
Route::post('/getuserbysearch', 'UserControlController@getuserbysearch')->name('getuserbysearch');
Route::get('/userdetail/{userid}', 'UserControlController@userdetail')->name('userdetail/{$userid}');

Route::get('/listingscontrol', 'ListingsControlController@index')->name('listingscontrol');
Route::get('/viewalllistings', 'ListingsControlController@viewalllistings')->name('viewalllistings');