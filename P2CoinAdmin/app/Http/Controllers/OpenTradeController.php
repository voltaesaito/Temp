<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Common;

class OpenTradeController extends Controller
{
    //
    public function index() {
        $model = new Common();
        $trade_list = $model->getOpenTradeList()->toArray();
        $ret_arr = array();
        $price_data = $model->getCurrentPrice();    
        foreach( $trade_list as $trade ) {
            $trade_arr = $model->getArrayfromStdObj($trade);
            $fiat_amount = $trade_arr['coin_amount']*$price_data[$trade_arr['coin_type']];
            $senderInfo = $model->getUserinfoById($trade_arr['coin_sender_id']);
            $receiverInfo = $model->getUserinfoById($trade_arr['coin_receiver_id']);
            $trade_arr['seller'] = $senderInfo['name'];
            $trade_arr['buyer'] = $receiverInfo['name'];
            $trade_arr['fiat_amount'] = $fiat_amount;
            $ret_arr[] = $trade_arr;
        }
        return view('opentrade.index')->with('trade_arr', $ret_arr);
    }
}
