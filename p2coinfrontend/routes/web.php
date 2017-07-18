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
Route::post('/index', 'IndexController@index')->name('index');
Auth::routes();

Route::get('/changepassword', 'Auth\ChangePasswordController@index')->name('changepassword');
Route::post('/resetpassword', 'Auth\ChangePasswordController@resetpassword')->name('resetpassword');
Route::get('/changephone', 'Auth\ChangeEmailController@changephone')->name('changephone');
Route::post('/changepersonphonenumber', 'Auth\ChangeEmailController@changepersonphonenumber')->name('changepersonphonenumber');
Route::get('/change2fa', 'Auth\ChangeEmailController@twofaindex')->name('change2fa');
Route::get('/verifyphone', 'Auth\VerifyPhoneController@index')->name('verifyphone');
Route::get('/verifyid', 'Auth\VerifyIDController@index')->name('verifyid');
Route::post('/chat','ChatController@sendMessage')->name('chat');
 
Route::get('/chat','ChatController@chatPage')->name('chat');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/trade', 'TradeController@index')->name('trade');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/buy', 'BuyerController@index')->name('buyer');
Route::get('/managelistings', 'ManageListingsController@index')->name('managelistings');
Route::get('/editlistings', 'ManageListingsController@editlistings')->name('editlistings');
Route::post('/storelistings', 'ManageListingsController@storelistings')->name('storelistings');

Route::get('/sell', 'SellerController@index')->name('seller');
Route::get('/chatroom', 'ChatRoomController@index')->name('chatroom');
Route::get('/trademessage', 'TradeMessageController@index')->name('trademessage');
Route::post('/addmessage', 'TradeMessageController@addmessage')->name('addmessage');
Route::get('/wallet', 'WalletController@index')->name('wallet');
Route::get('/settings', 'SettingsController@index')->name('wallet');
Route::get('/userprofile', 'UserProfileController@index')->name('userprofile');
Route::get('/verify/email/{token}', 'VerifyController@email')->name('verify/email/{token}');