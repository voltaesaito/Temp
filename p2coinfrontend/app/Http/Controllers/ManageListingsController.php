<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listings;

use App\Models\WalletManage;
use App\Models\UserWallet;
use App\Models\TransactionHistory;
use App\Models\ContractModel;

class ManageListingsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {   
        $user = \Auth::user();
        $listings = Listings::all()->where('user_id', '=', $user->id)->sortByDesc('created_at');  

        return view('manage.index')->with('listings', $listings);
    }
    public function editlistings() {
        $user = \Auth::user();
        $userWalletInfo = UserWallet::where('user_id', '=', $user->id)->first();
// dd($userWalletInfo);        
        $model = new WalletManage();
        $wallet_info = $model->getWalletBalanceByAddress($userWalletInfo->wallet_address);
        $coin_balance= floatval($wallet_info->data->available_balance);

        return view('manage.listings')->with('coin_balance', $coin_balance);
    }
    public function changestatus(Request $request) {
        $listing_id = $request->listing_id;
        $status = $request->status;
        $listing_row = Listings::find($listing_id);
        $listing_row->status = $status;
        $listing_row->save();
        echo 'ok';
        exit;
    }
    public function storelistings(Request $request) {
        $user_type = $request->user_type;
        $coin_type = $request->coin_type;
        if($user_type == 0){
//            $wallet_address = $request->wallet_address;
            $coin_amount = $request->coin_amount;
        }
        $location = $request->location;
        $payment_method = $request->payment_method;
        $payment_name = $request->payment_name;
        $currency = $request->currency;
        $min_transaction_limit = $request->min_transaction_limit;
        $max_transaction_limit = $request->max_transaction_limit;
        $price_equation = $request->price_equation;
        $terms_of_trade = $request->terms_of_trade;
        $payment_details = $request->payment_details;
        $user = \Auth::user();
        
        $listing = new Listings();
        $listing->user_id=$user->id;
        $listing->user_type=$user_type;
        $listing->coin_type=$coin_type;
        if($user_type == 0){
//            $listing->wallet_address=$wallet_address;
            $listing->coin_amount=$coin_amount;
        }
        $listing->location = $location;
        $listing->payment_method = $payment_method;
        $listing->payment_name = $payment_name;
        $listing->currency = $currency;
        $listing->min_transaction_limit = $min_transaction_limit;
        $listing->max_transaction_limit = $max_transaction_limit;
        $listing->price_equation = $price_equation;
        $listing->terms_of_trade = $terms_of_trade;
        $listing->payment_details = $payment_details;
        $listing->save();

        /**  
            @TODO *** Here is deposit operation procedure

        **/
/*
        $model = new WalletManage();
        $user = \Auth::user();
        $userWalletInfo = UserWallet::where('user_id', '=', $user->id)->first();
        $model = new WalletManage();
        $userWallet = $userWalletInfo->wallet_address;
        $model->deposit($coin_amount, $userWallet);
*/
        /** ************************** ******************************* */

        return redirect()->action('ManageListingsController@index');
    }
    public function withdraw( Request $request ) {
        $transaction_id = $request->transaction_id;

        // $contract_data = 
        $row = TransactionHistory::all()->where('transaction_id','=',$transaction_id)->first();
        $coin_amount = $row->coin_amount;
        $sender_id = $row->coin_sender_id;
        $receiver_id = $row->coin_receiver_id;
        $temp_row = UserWallet::all()->where('user_id', '=', $sender_id)->first();
        $sender_wallet = $temp_row->wallet_address;
        $temp_row = UserWallet::all()->where('user_id', '=', $receiver_id)->first();
        $receiver_wallet = $temp_row->wallet_address;

        $model = new WalletManage();
        $data = $model->getTransFee($coin_amount, $receiver_wallet);
        $model->withdrawExt($data['amount'], $data['site_fee'], $sender_wallet, $receiver_wallet);
        echo 'ok';
        exit;
    }
    public function gettransactionid( Request $request ) {
        $contract_id = $request->contract_id;
        try {
            $row = TransactionHistory::all()->where('contract_id','=',$contract_id)->first();
            echo $row->transaction_id;
        }
        catch( Exception $e ) {
            echo 'fail';
        }
        exit;
    }
    public function userbalance() {
        $user = \Auth::user();
        $userWalletInfo = UserWallet::where('user_id', '=', $user->id)->first();
        $model = new WalletManage();
        $wallet_info = $model->getWalletBalanceByAddress($userWalletInfo->wallet_address);
        $coin_balance= floatval($wallet_info->data->available_balance);
        echo $coin_balance;
        exit;
    }
}
