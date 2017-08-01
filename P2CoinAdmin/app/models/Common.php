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
}
