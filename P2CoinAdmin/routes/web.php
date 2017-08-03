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

Route::post('/getvolume', 'StatisticsController@getVolume')->name('getvolume');
Route::post('/getrevenu', 'StatisticsController@getRevenu')->name('getrevenu');
Route::post('/gettrades', 'StatisticsController@getTrades')->name('gettrades');
Route::post('/getlistings', 'StatisticsController@getListings')->name('getlistings');
Route::post('/getsignupusers', 'StatisticsController@getSignUpUsers')->name('getsignupusers');

Route::get('/opentrade', 'OpenTradeController@index')->name('opentrade');

Route::get('/changeverified', 'ChangeVerifiedUserController@index')->name('changeverified');
Route::get('/changestatus', 'ChangeVerifiedUserController@changestatus')->name('changestatus');

Route::get('/disputes', 'DisputesController@index')->name('disputes');

Route::get('/deposits', 'DepositsController@index')->name('deposits');

Route::get('/withdrawals', 'WithdrawalsController@index')->name('withdrawals');

Route::get('/websitewallet', 'WebsiteWalletController@index')->name('websitewallet');