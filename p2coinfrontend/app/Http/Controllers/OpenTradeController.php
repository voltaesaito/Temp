<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OpenTradeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {

        $user = \Auth::user();
        $user_id = $user->id;

        //
        $sell_listings = DB::table('listings')
                        ->join('users', 'listings.user_id', '=', 'users.id')
                        ->join('contract', 'listings.id', '=', 'contract.listing_id')
                        ->join('transaction_history', 'transaction_history.contract_id', '=', 'contract.id')
                        ->select('contract.*', 'users.name', 'transaction_history.coin_amount', 'listings.payment_method')
                        ->where('listings.is_closed', '=', '0')->where('contract.sender_id', '=', $user->id)->where('listings.user_type', '=', 0)
//                        ->where('listings.user_id', '=', 'contract.receiver_id')
                        ->orderBy('contract.created_at', 'desc')
                        ->get();

        $buy_listings = DB::table('listings')
                        ->join('users', 'listings.user_id', '=', 'users.id')
                        ->join('contract', 'listings.id', '=', 'contract.listing_id')
                        ->join('transaction_history', 'transaction_history.contract_id', '=', 'contract.id')
                        ->select('contract.*', 'users.name', 'transaction_history.coin_amount', 'listings.payment_method')
                        ->where('listings.is_closed', '=', '0')->where('contract.receiver_id', '=', $user->id)->where('listings.user_type', '=', 0)
                        ->where('listings.user_id', '=', 'contract.sender_id')
//                        ->orderBy('contract.created_at', 'desc')
                        ->get();

        return view('trade.opentrade')->with('sell_listings', $sell_listings)->with('buy_listings', $buy_listings);
    }
}
