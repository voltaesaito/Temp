<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database;
class Listings extends Model
{
    //
    protected $table = 'listings';

    /**
        This function 
        @param: $user_id - logged in User Id
                $type    - 0 seller,  1 buyer
                $init    - flag for see more action { 1 - limit 5, 0 - all }
                $filter_param - filter request array
                    { coin_amount, coin_type, location, payment_method }
        @return Array
        @Author : Daiki Isoroku87
    */
    public function getListingsData( $user_id, $type = 0, $init =1, $filter_param=array() ) {

        $data = DB::table('listings')
            ->join('users', 'users.id', '=', 'listings.user_id')
            ->select('listings.*', 'users.name')
            ->where( 'user_id', '<>', $user_id )->where( 'is_closed', '=', '0')->where('status', '=',1 )->where('user_type', '=', $type);

//        $data = self::all()->where( 'user_id', '<>', $user_id )->where( 'is_closed', '=', '0')->where('status', '=',1 )->where('user_type', '=', $type);

        if ( count($filter_param)>0 ) {
            if ( isset($filter_param['coin_amount']) && $filter_param['coin_amount']>0 )
                 $data->where('coin_amount', '>=', $filter_param['coin_amount']);
            if ( isset($filter_param['coin_type']) ) $data->where('coin_type', '=', $filter_param['coin_type']);
            if ( $filter_param['location'] != 'none' )
                $data->where("location", "LIKE", "JP");
            if (  isset($filter_param['payment_method']) && $filter_param['payment_method'] != 'none' )
                $data->where("payment_method", "LIKE", "'%" . $filter_param['payment_method'] . "%'");
        }

//        $data->sortByDesc('created_at');

        $data->orderBy('created_at', 'asc');
        if ( $init )
            $data->offset(0)->limit(5);
//        $data->get();
        return $data->get()->toArray();
    }
}
