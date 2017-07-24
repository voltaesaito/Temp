<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    //
    protected $table = 'user_wallet';
    
    public function getUserWallet( $user_id, $wallet_type=null ) {
        $row = self::all()->where('user_id', '=', $user_id)->first();
        return $row->wallet_address;
    }
}