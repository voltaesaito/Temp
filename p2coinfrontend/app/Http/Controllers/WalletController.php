<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BlockchainWalletMng;
use App\Models\UserWallet;
use App\Models\WalletManage;

class WalletController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $wallet_info = array();
        $user = Auth::user();
        $model = new UserWallet();
        $btcAddress = $model->getUserWallet($user->id, 'btc');
        $wallet_info[] = array('coin'=>'Bitcoin', 'abbrev'=>'BTC', 'address'=>$btcAddress);
        $ethAddress = $model->getUserWallet($user->id, 'eth');
        $wallet_info[] = array('coin'=>'Ethereum', 'abbrev'=>'ETH', 'address'=>$ethAddress);

        return view('wallet.index')->with('wallet_info', $wallet_info);
    }
    public function deposit(Request $request) {
        $src_address = $request->src_address;
        $deposit_amount = $request->deposit_amount;
        $private_key = $request->private_key;

        $user = \Auth::user();

    }
    public function withdraw(Request $request) {

    }
}
