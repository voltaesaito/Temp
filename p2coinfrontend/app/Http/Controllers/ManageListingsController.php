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
//dd($listings);        
        return view('manage.index')->with('listings', $listings);
    }
    public function editlistings() {
        return view('manage.listings');
    }
    public function storelistings(Request $request) {
        $location = $request->location;
        $payment_method = $request->payment_method;
        $payment_name = $request->payment_name;
        $currency = $request->currency;
        $min_transaction_limit = $request->min_transaction_limit;
        $max_transaction_limit = $request->max_transaction_limit;
        $terms_of_trade = $request->terms_of_trade;
        $payment_details = $request->payment_details;
        $user = \Auth::user();
        
        $listing = new Listings();
        $listing->user_id=$user->id;
        $listing->location = $location;
        $listing->payment_method = $payment_method;
        $listing->payment_name = $payment_name;
        $listing->currency = $currency;
        $listing->min_transaction_limit = $min_transaction_limit;
        $listing->max_transaction_limit = $max_transaction_limit;
        $listing->terms_of_trade = $terms_of_trade;
        $listing->payment_details = $payment_details;
        $listing->save();

        return redirect()->action('ManageListingsController@index');
    }
}
