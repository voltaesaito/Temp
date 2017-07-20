<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listings;

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
        return view('manage.listings');
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

        return redirect()->action('ManageListingsController@index');
    }
}
