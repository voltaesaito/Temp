<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listings;

class BuyerController extends Controller
{
    //
    public function index(Request $request) {

        $listing_id = $request->listing_id;
        $listings = listings::all()->where('id', '=', $listing_id);
        foreach($listings as $list){
            $listing = $list;
            break;
        }
        
        return view('buy.index')->with('listing', $listing);
    }
}
