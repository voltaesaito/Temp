<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    //
    protected $table = 'user_wallet';
    
    public function getUserWallet( $user_id, $wallet_type=null ) {
        if ( is_null($wallet_type) ) $wallet_type = 'btc';
        $row = self::all()->where('user_id', '=', $user_id)->where('wallet_type', '=', $wallet_type)->first();
        return $row->wallet_address;
    }
    public function getWalletInfo( $user_id, $wallet_type ) {
        if ( is_null($wallet_type) ) $wallet_type = 'btc';
        $row = self::all()->where('user_id', '=', $user_id)->where('wallet_type', '=', $wallet_type)->first();
        return $row;
    }
}
