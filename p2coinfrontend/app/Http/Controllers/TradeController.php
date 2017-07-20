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
        $user = \Auth::user();
        $listings = DB::select("SELECT l.*, u.name FROM `listings` l
                                join users u
                                on u.id = l.user_id
                                where l.user_id<>{$user->id} and l.status = 1 
                                order by created_at DESC");
    //    dd($listings);
        return view('trade.screen')->with('listings', $listings)->with('location', 'Australia');
    }
    private function getUserData() {

    }
}
