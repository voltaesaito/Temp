<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletManage;
class DashboardController extends Controller
{
    //
    public function index() {
        // $model = new WalletManage();
        //002$wallet_arr = $model->generateWallet();
        //$sendAmount = bcmul($getBalanceInfo->data->available_balance, '0.01', 8);
        //dd($model->getWalletBalanceByAddress('3PJiUQuKbY3bBZotgUzxXRZbdtndMCCACm'));
        // dd($model->sendCoin(0.001002,'2N2Sgn1wdwHQbsgEZuGJw882XKdJg5vJN8v', '2MwvKcGZvdqr4nBDk2zRXB7nxCv7sseRYX7',$model->getPinCode()));
        return view('index.dashboard');
    }
}
