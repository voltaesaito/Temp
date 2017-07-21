<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletManage;
use App\Models\UserWallet;

class DashboardController extends Controller
{
    //
    public function index() {
        $user = \Auth::user();
        $userWalletRow = UserWallet::all()->where('user_id', '=', $user->id)->first();
        $model = new WalletManage();
        $wallet_info = $model->getWalletBalanceByAddress($userWalletRow->wallet_address);
        $coin_balance= floatval($wallet_info->data->available_balance);
        session()->put('btc_amount', $coin_balance);

        return redirect()->action('TradeController@index');
        // return view('index.dashboard');
    }
}
