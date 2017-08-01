<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Common extends Model
{
    //
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
//                        ->where('listings.user_id', '=', 'contract.receiver_id')
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
}
