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
Route::get('/verifyready', 'Auth\RegisterController@verifyready')->name('verifyready');


Route::post('/chat','ChatController@sendMessage')->name('chat');
 
Route::get('/chat','ChatController@chatPage')->name('chat');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/trade', 'TradeController@index')->name('trade');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::post('/buy', 'BuyerController@index')->name('buyer');
Route::get('/managelistings', 'ManageListingsController@index')->name('managelistings');
Route::get('/messagebox', 'TradeMessageController@messagebox')->name('messagebox');
Route::get('/addlistings/{listing_id}', 'ManageListingsController@addlistings')->name('addlistings/{listing_id}');
//Route::get('/editlistings/{listing_id}', 'ManageListingsController@editlistings')->name('editlistings/{listing_id}');
Route::get('/viewlisting/{listing_id}', 'ManageListingsController@viewlisting')->name('viewlisting/{listing_id}');
Route::get('/getuserbalance', 'ManageListingsController@userbalance')->name('getuserbalance');
Route::post('/storelistings', 'ManageListingsController@storelistings')->name('storelistings');
Route::post('/changestatus', 'ManageListingsController@changestatus')->name('changestatus');
Route::post('/withdraw', 'ManageListingsController@withdraw')->name('withdraw');
Route::post('/gettransactionid', 'ManageListingsController@gettransactionid')->name('gettransactionid');


Route::get('/sell', 'SellerController@index')->name('seller');
Route::get('/chatroom', 'ChatRoomController@index')->name('chatroom');
Route::get('/trademessage', 'TradeMessageController@index')->name('trademessage');
Route::post('/createcontract', 'TradeMessageController@createcontract')->name('createcontract');
Route::post('/createcont', 'TradeMessageController@createcont')->name('createcont');
Route::post('/addmessage', 'TradeMessageController@addmessage')->name('addmessage');

Route::get('/wallet', 'WalletController@index')->name('wallet');
Route::post('/deposit', 'WalletController@deposit')->name('deposit');
Route::post('/coinwithdraw', 'WalletController@withdraw')->name('coinwithdraw');
Route::post('/generateqrcode', 'WalletController@generateqrcode')->name('generateqrcode');


Route::get('/settings', 'SettingsController@index')->name('settings');
Route::get('/userprofile', 'UserProfileController@index')->name('userprofile');
Route::get('/verify/email/{token}', 'VerifyController@email')->name('verify/email/{token}');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/getlistingdata','TradeController@getListingData')->name('getlistingdata');
Route::post('/getlistingdatabyuser','ManageListingsController@getListingDataByUser')->name('getlistingdatabyuser');
Route::post('/getalllistingdata','IndexController@getListingData')->name('getalllistingdata');
Route::post('/getlastmessagelist','IndexController@getLastMessageList')->name('getlastmessagelist');