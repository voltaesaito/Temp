<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Common extends Model
{
    //
    private $wallet_data;
    public function getUserList( $useremail=null, $username=null ) {
        $data = DB::table('users')->select('users.*');        
        if ( !is_null($useremail) ) $data->where('email', 'like', "%".$useremail."%");
        if ( !is_null($username) ) $data->where('name', 'like', "%".$username."%");
        return $data->get()->toArray();
    }
    public function getUserinfoById( $user_id ) {
        $data = DB::table('users')->select('users.*')->where('id', '=', $user_id)->get()->toArray();
        return self::getArrayfromStdObj($data[0]);
    }
    public function getArrayfromStdObj($stdObj){
        $ret_arr = array();
        foreach( $stdObj as $key=>$val ) $ret_arr[$key] = $val;
        return $ret_arr;
    }
    public function getAllListingsData() {
        $listings = DB::table('listings')
                    ->join('users', 'listings.user_id', '=', 'users.id')
                    // ->join('contract', 'listings.id', '=', 'contract.listing_id')
                    // ->join('transaction_history', 'transaction_history.contract_id', '=', 'contract.id')
                    ->select('listings.*', 'users.name')
                    ->where('listings.is_closed', '=', '0')
                    // ->orderBy('contract.created_at', 'desc')
                    ->get();
        return $listings;
    }
    public function getOpenTradeList() {
        $trades = DB::table('listings')
                    ->join('users', 'listings.user_id', '=', 'users.id')
                    ->join('contract', 'listings.id', '=', 'contract.listing_id')
                    ->join('transaction_history', 'transaction_history.contract_id', '=', 'contract.id')
                    ->select('transaction_history.*','listings.*', 'users.name','users.email')
                    ->where('listings.is_closed', '<>', '0')
                    ->orderBy('contract.created_at', 'desc')
                    ->get();
        return $trades;
    }
    public function getCurrentPrice() {
        $ch = curl_init("https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=USD");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $btc_data_str = json_decode(curl_exec($ch));
        curl_close($ch);


        $ch = curl_init("https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=USD");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $eth_data_str = json_decode(curl_exec($ch));
        curl_close($ch);

        $btc = $btc_data_str[0];
        $eth = $eth_data_str[0];
        $return_data = array('btc'=>$btc->price_usd, 'eth'=>$eth->price_usd);
        return $return_data;
    }
    public function updateUserVerification($user_id, $type, $status) {
        $field_arr = array('sms'=>'phone_verify', 'id'=>'id_verify');
        try{
            DB::table('users')
                ->where('id', '=',$user_id)
                ->update([$field_arr[$type] => $status]);
            return true;
        }
        catch(exception $exp) {
            return false;
        }
        
    }
    public function getPendingWithdrawals() {
        $transaction_history_data = DB::table('transaction_history')->select()->distinct()->where('status_col', '=', '0')->get()->toArray();
        $transaction_history_data = DB::table('listings')
                        ->join('contract', 'listings.id', '=', 'contract.listing_id')
                        ->join('transaction_history', 'transaction_history.contract_id', '=', 'contract.id')
                        ->select('contract.*', 'listings.coin_type', 'transaction_history.*', 'listings.payment_method')
                        ->where('listings.is_closed', '=', '0')
                        ->orderBy('contract.created_at', 'desc')
                        ->get();
        $user_list = DB::table('users')->select()->get()->toArray();
        $this->wallet_data = DB::table('user_wallet')->select()->get()->toArray();

        $user_data = array();
        foreach( $user_list as $list ) {
            $user_data[$list->id] = array('name'=>$list->name, 'email'=>$list->email, 'wallet_info'=>$this->getArrayDataFromWallet($list->id));
        }
        $transaction_arr = array();
        $status_arr = array('progressing','pending','released');
        foreach ($transaction_history_data as $transaction ) {
            $ret_arr = array();
            $ret_arr['sender'] = $user_data[$transaction->coin_sender_id];
            $ret_arr['receiver'] = $user_data[$transaction->coin_receiver_id];
            $ret_arr['coin_amount'] = $transaction->coin_amount;
            $ret_arr['date'] = $transaction->created_at;
            $ret_arr['status'] = $status_arr[$transaction->status_col];
            $ret_arr['coin_type'] = $transaction->coin_type;
            $transaction_arr[] = $ret_arr;
        }

        return $transaction_arr;
    }
    public function getArrayDataFromWallet( $user_id ) {
        $ret_arr = array();
        foreach( $this->wallet_data as $info ){
            if ( $info->user_id == $user_id ) {
                $ret_arr[$info->wallet_type]['wallet_address'] = $info->wallet_address;
                $ret_arr[$info->wallet_type]['private'] = $info->private;
                $ret_arr[$info->wallet_type]['public'] = $info->public;
                // $ret_arr['type'] = $info->wallet_type;
            }
        }
        return $ret_arr;
    }
    public function getWithdrawalHistory() {
        $withdrawal_history_data = DB::table('users')
            ->join('withdrawal_history', 'users.id', '=', 'withdrawal_history.user_id')
            ->select('withdrawal_history.*', 'users.name')
//            ->where('listings.is_closed', '=', '0')
            ->orderBy('withdrawal_history.created_at', 'desc')
            ->get();
        return $withdrawal_history_data->toArray();
    }
    public function deleteListing($listing_id) {
        try {
            DB::table('listings')->where('id', '=', $listing_id)->delete();
            return 'true';
        }
        catch( Exception $exp ) {
            return 'fail';
        }
    }
    public function updateListingStatus($listing_id, $is_closed_status) {
        try{
            DB::table('listings')
                ->where('id', '=',$listing_id)
                ->update(['is_closed'=>$is_closed_status]);
            return true;
        }
        catch(exception $exp) {
            return false;
        }

    }
    public function changeuserBlockStatus($user_id, $type, $status) {
        $status = 1 - $status;
        $ret = DB::table('user_login_status')->where('user_id', '=', $user_id)
                ->update(['block_'.$type=>$status]);
        return $ret;
    }
    public function getUserStatus($user_id) {
        $data = DB::table('user_login_status')->where('user_id', '=', $user_id)->get();
        return $data[0];
    }
}