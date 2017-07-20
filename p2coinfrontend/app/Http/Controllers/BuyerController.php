<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listings;
use App\Models\ContractModel;

class BuyerController extends Controller
{
    //
    public function index(Request $request) {

        $user = \Auth::user();
        $listing_id = $request->listing_id;
        $sender_id = $user->id;
        $receiver_id = $request->user_id;

        $newRow = new ContractModel();
        $newRow->sender_id = $sender_id;
        $newRow->receiver_id = $receiver_id;
        $newRow->listing_id = $listing_id;
        $status = $newRow->save();
        if ( $status ) {
            $contract_id = $newRow->id;
        }

        $listings = listings::all()->where('id', '=', $listing_id);
        foreach($listings as $list){
            $listing = $list;
            break;
        }
        
        return view('buy.index')->with('listing', $listing)->with('contract_id', $contract_id)->with('receiver_id', $receiver_id)->with('listing_id', $listing_id);
    }
}
