<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Common;


class DisputesController extends Controller
{
    //
    public function index() {
        $model = new Common();
        $dispute_list = $model->getDesiputeList();
        $ret_arr = array();
        foreach( $dispute_list as $dispute ) {
            $sender_user_info = $model->getUserinfoById($dispute->coin_sender_id);
            $receiver_user_info = $model->getUserinfoById($dispute->coin_receiver_id);
            $tmp_arr = array();
            foreach( $dispute as $key=>$val )  $tmp_arr[$key] = $val;
            $tmp_arr['sender'] = $sender_user_info['name'];
            $tmp_arr['receiver'] = $receiver_user_info['name'];
            $ret_arr[] = $tmp_arr;
        }
        return view('disputes.index')->with(['dispute_list'=>$ret_arr]);
    } 
}
