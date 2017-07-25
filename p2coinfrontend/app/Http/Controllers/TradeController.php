<?php

namespace App\Http\Controllers;

use App\Models\Listings;

use Illuminate\Http\Request;
use DB;

class TradeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        return view('trade.screen');
    }

    public function getListingData(Request $request) {
        $flag = $request->flag;
        $localinfo = session()->get('locationinfo');
        $user = \Auth::user();
        $lModel = new Listings();

        $crypto_name = "Cryptocurrencies";
        if($request->coin_type == "btc")
            $crypto_name = "Bitcoin";
        if($request->coin_type == "eth")
            $crypto_name = "Ethereum";

        if($request->flag == true){
            $buy_listings = $lModel->getListingsData($user->id, 1, 1, array('location'=>$localinfo['country']));
            $sell_listings = $lModel->getListingsData($user->id, 0, 1, array('location'=>$localinfo['country']));
            $location = $crypto_name . " in " . $localinfo['country'];
        }else{
            $buy_listings = $lModel->getListingsData($user->id, 1, 0, $request);
            $sell_listings = $lModel->getListingsData($user->id, 0, 0, $request);
            $location = $crypto_name . " in " . $request->location;
        }

        $buy_list = "";
        foreach($buy_listings as $listing){
            $buy_list .= "<tr>";
            $buy_list .= "<td>" . $listing->name . "</td>";
            $buy_list .= "<td>" . $listing->coin_type . "-" . $listing->payment_method . "</td>";
            $buy_list .= "<td>" . round($listing->coin_amount, 2) . " " . $listing->currency . "</td>";
            $buy_list .= "<td>" . $listing->min_transaction_limit . "-" . $listing->max_transaction_limit . " " . $listing->currency . "</td>";
            $buy_list .= "<td>";
            $buy_list .= "<a href='buy?listing_id=" . $listing->id . "&user_id=" . $listing->user_id . " class='btn btn-success btn-green'>BUY</a>";
            $buy_list .= "</td>";                       
            $buy_list .= "</tr>";
        }

        $sell_list = "";
        foreach($sell_listings as $listing){
            $sell_list .= "<tr>";
            $sell_list .= "<td>" . $listing->name . "</td>";
            $sell_list .= "<td>" . $listing->coin_type . "-" . $listing->payment_method . "</td>";
            $sell_list .= "<td>" . round($listing->coin_amount, 2) . " " . $listing->currency . "</td>";
            $sell_list .= "<td>" . $listing->min_transaction_limit . "-" . $listing->max_transaction_limit . " " . $listing->currency . "</td>";
            $sell_list .= "<td>";
            $sell_list .= "<a href='buy?listing_id=" . $listing->id . "&user_id=" . $listing->user_id . " class='btn btn-success btn-green'>BUY</a>";
            $sell_list .= "</td>";                       
            $sell_list .= "</tr>";
        }

        echo $location . "@@@" . $buy_list . "@@@" . $sell_list;
        exit;
        // return view('trade.screen')->with('buy_listings', $buy_listings)->with('sell_listings', $sell_listings)->with('location', $localinfo['country_full_name']);
    }
}
