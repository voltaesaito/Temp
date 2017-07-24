<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserWallet;

class ProfileController extends Controller
{
    //
    public function index() {
        $userWalletInfo = new UserWallet();
        $user = \Auth::user();
        $userWalletAddress = $userWalletInfo->getUserWallet($user->id);
        return view('profile.index')->with('wallet_address', $userWalletAddress)->with('user', $user);
    } 
}
