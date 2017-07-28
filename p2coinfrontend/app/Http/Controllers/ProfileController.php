<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Models\UserWallet;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        try {
            $userWalletInfo = new UserWallet();
            $user = \Auth::user();
            $from_date = date_create($user->created_at);
//            $from_date = date_create("2013-01-01");
            $to_date = date_create(date('Y-m-d H:m:s'));
            $diff = date_diff($from_date, $to_date);
//            dd($diff);
            $trader_age = $diff->format("%d days %h hours %i minutes %s seconds");
            $userWalletAddress = $userWalletInfo->getUserWallet($user->id);
            return view('profile.index')->with('wallet_address', $userWalletAddress)->with('user', $user)
                ->with(['buy_title'=>'Buy Bitcoins from BTC Trade','sell_title'=>'Sell Bitcoins from BTC Trade', 'trader_age'=>$trader_age]);
        }
        catch( Exception $e ) {
            return redirect()->action('/');
        }
        
    } 
}
