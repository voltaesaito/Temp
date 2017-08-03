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
Route::post('/blockuser', 'UserControlController@blockuser')->name('blockuser');

Route::get('/listingscontrol', 'ListingsControlController@index')->name('listingscontrol');
Route::get('/viewalllistings', 'ListingsControlController@viewalllistings')->name('viewalllistings');
Route::get('/deletelisting/{listing_id}', 'ListingsControlController@deletelisting');

Route::get('/opentrade', 'OpenTradeController@index')->name('opentrade');
Route::post('/releasetrade', 'OpenTradeController@releasetrade')->name('releasetrade');

Route::get('/changeverified', 'ChangeVerifiedUserController@index')->name('changeverified');
Route::get('/changestatus', 'ChangeVerifiedUserController@changestatus')->name('changestatus');

Route::get('/disputes', 'DisputesController@index')->name('disputes');

Route::get('/deposits', 'DepositsController@index')->name('deposits');

Route::get('/withdrawals', 'WithdrawalsController@index')->name('withdrawals');

Route::get('/websitewallet', 'WebsiteWalletController@index')->name('websitewallet');