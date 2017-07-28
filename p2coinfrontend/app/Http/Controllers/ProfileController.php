<?php

namespace App\Http\Controllers;

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
            $userWalletAddress = $userWalletInfo->getUserWallet($user->id);
            return view('profile.index')->with('wallet_address', $userWalletAddress)->with('user', $user)->with(['buy_title'=>'Buy Bitcoins from BTC Trade','sell_title'=>'Sell Bitcoins from BTC Trade']);
        }
        catch( Exception $e ) {
            return redirect()->action('/');
        }
        
    } 
}
